<?php

namespace PlureGames\PlureApps\Services\UserSession;

use Carbon\Carbon;

class CloseSessions
{
    public function closeExpiredSessions(): void
    {
        \PlureGames\PlureApps\Models\UserSession::whereNull('close_reason')
            ->where('last_event_at', '<=', Carbon::now()->subMinutes(UserSession::TIMEOUT_MIN))
            ->update([
                'close_reason' => UserSession::CLOSE_REASON_TIMEOUT,
                'ended_at' => Carbon::now(),
            ]);
    }
}
