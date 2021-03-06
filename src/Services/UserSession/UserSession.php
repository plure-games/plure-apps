<?php

namespace PlureGames\PlureApps\Services\UserSession;

use PlureGames\PlureApps\Events\IpChangedEvent;
use App\Models\TempUser;
use Illuminate\Support\Carbon;
use PlureGames\PlureApps\Models\UserSession as Session;

class UserSession
{
    public const TIMEOUT_MIN = 15;

    public const CLOSE_REASON_TIMEOUT = 'timeout';
    public const CLOSE_REASON_COUNTRY_CHANGE = 'country_change';

    private Carbon $now;

    public function ping(TempUser $tempUser, array $params): void
    {
        $lastSession = Session::whereTempUserId($tempUser->temp_user_id)
            ->orderByDesc('id')
            ->first();

        $this->now = Carbon::now();
        $firstSession = false;

        if (!$lastSession) {
            $lastSession = $this->createNewSession($tempUser, $params, null);
            $firstSession = true;
        }

        if ($lastSession->close_reason) {
            $this->createNewSession($tempUser, $params, $lastSession);

            return;
        }

        $countryChanged =
            ($params['country'] ?? null) &&
            $params['country'] !== 'ZZ' &&
            $params['country'] !== $lastSession->country;

        $usStateChanged =
            ($params['country'] ?? null) &&
            $params['country'] === 'US' &&
            ($params['state'] !== $lastSession->state || $lastSession->country !== 'US');

        if (!$firstSession && ($countryChanged || $usStateChanged)) {
            $lastSession->close_reason = self::CLOSE_REASON_COUNTRY_CHANGE;
            $lastSession->ended_at = $this->now;
            $lastSession->save();
            $this->createNewSession($tempUser, $params, $lastSession);

            return;
        }

        if ($lastSession->last_event_at->diffInMinutes($this->now) >= self::TIMEOUT_MIN) {
            $lastSession->close_reason = self::CLOSE_REASON_TIMEOUT;
            $lastSession->ended_at = $this->now;
            $this->createNewSession($tempUser, $params, $lastSession);
        } elseif ($lastSession && !empty($params['ip'])) {
            if (!($params['bot'] ?? false) && $params['ip'] !== $lastSession->ip) {
                event(new IpChangedEvent($params['ip'], $lastSession));
            }
        }

        if (!$firstSession) {
            $lastSession->last_event_at = $this->now;
            $lastSession->save();
        }
    }

    private function createNewSession(
        TempUser $tempUser,
        array    $params,
        ?Session  $lastSession,
    ): Session
    {
        $bot = $params['bot'] ?? false;
        $ip = $params['ip'] ?? null;
        $ipChanged = false;

        if (!$bot && $ip !== $lastSession?->ip) {
            $ipChanged = true;
        }

        $session = Session::create([
            'app_id' => $tempUser->app_id,
            'temp_user_id' => $tempUser->temp_user_id,
            'started_at' => $this->now,
            'last_event_at' => $this->now,
            'ended_at' => null,
            'is_first_session' => is_null($lastSession),
            'close_reason' => null,
            'start_url' => $params['start_url'] ?? null,
            'referral' => $params['referral'] ?? null,
            'user_agent' => $params['user_agent'] ?? null,
            'device_info' => $params['device_info'] ?? null,
            'device_cap' => $params['device_cap'] ?? null,
            'ip' => $ip,
            'country' => $params['country'] ?? null,
            'state' => $params['state'] ?? null,
            'bot' => $bot,
            'is_vpn' => $ipChanged ? $lastSession?->is_vpn : 0,
        ]);

        if ($ipChanged) {
            event(new IpChangedEvent($ip, $session));
        }

        return $session;
    }
}
