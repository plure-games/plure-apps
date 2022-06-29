<?php

namespace PlureGames\PlureApps\Events;

use Illuminate\Foundation\Events\Dispatchable;
use PlureGames\PlureApps\Models\UserSession;

class IpChangedEvent
{
    use Dispatchable;

    public function __construct(
        public readonly string $ip,
        public readonly UserSession $userSession,
    )
    {
    }
}
