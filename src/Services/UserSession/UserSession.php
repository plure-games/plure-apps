<?php

namespace PlureGames\PlureApps\Services\UserSession;

use App\Models\TempUser;
use Illuminate\Support\Carbon;

class UserSession
{
    public const TIMEOUT_MIN = 15;

    public const CLOSE_REASON_TIMEOUT = 'timeout';
    public const CLOSE_REASON_COUNTRY_CHANGE = 'country_change';

    private Carbon $now;

    public function ping(TempUser $tempUser, array $params): void
    {
        $lastSession = \PlureGames\PlureApps\Models\UserSession::whereTempUserId($tempUser->temp_user_id)
            ->orderByDesc('id')
            ->first();

        $this->now = Carbon::now();
        $firstSession = false;

        if (!$lastSession) {
            $lastSession = $this->createNewSession($tempUser, $params, true);
            $firstSession = true;
        }

        if ($lastSession->close_reason) {
            $this->createNewSession($tempUser, $params, false);

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
            $this->createNewSession($tempUser, $params, false);

            return;
        }

        if ($lastSession->last_event_at->diffInMinutes($this->now) >= self::TIMEOUT_MIN) {
            $lastSession->close_reason = self::CLOSE_REASON_TIMEOUT;
            $lastSession->ended_at = $this->now;
            $this->createNewSession($tempUser, $params, false);
        }

        if (!$firstSession) {
            $lastSession->last_event_at = $this->now;
            $lastSession->save();
        }
    }

    private function createNewSession(
        TempUser $tempUser,
        array    $params,
        bool     $isFirstSession,
    ): \PlureGames\PlureApps\Models\UserSession
    {
        return \PlureGames\PlureApps\Models\UserSession::create([
            'app_id' => $tempUser->app_id,
            'temp_user_id' => $tempUser->temp_user_id,
            'started_at' => $this->now,
            'last_event_at' => $this->now,
            'ended_at' => null,
            'is_first_session' => $isFirstSession,
            'close_reason' => null,
            'start_url' => $params['start_url'] ?? null,
            'referral' => $params['referral'] ?? null,
            'user_agent' => $params['user_agent'] ?? null,
            'device_info' => $params['device_info'] ?? null,
            'device_cap' => $params['device_cap'] ?? null,
            'ip' => $params['ip'] ?? null,
            'country' => $params['country'] ?? null,
            'state' => $params['state'] ?? null,
            'bot' => $params['bot'] ?? false,
        ]);
    }
}
