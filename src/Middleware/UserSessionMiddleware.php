<?php

namespace PlureGames\PlureApps\Middleware;

use App\Facades\Geo;
use App\Models\TempUser;
use App\Services\IP;
use PlureGames\PlureApps\Services\UserSession\UserSession;
use Closure;
use Illuminate\Http\Request;
use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Laminas\Diactoros\Response\JsonResponse;

class UserSessionMiddleware
{
    public function __construct(
        private UserSession $userSession,
        private CrawlerDetect $crawlerDetect,
    )
    {
    }

    public function handle(
        Request     $request,
        Closure     $next,
    )
    {

        /** @var TempUser $tempUser */
        $tempUser = auth()->user();

        $params = [
            'user_agent' => $request->userAgent(),
            'ip' => IP::get(),
            'country' => Geo::code(IP::get()),
            'state' => Geo::stateCode(IP::get()),
            'bot' => $this->crawlerDetect->isCrawler(),
        ];

        $this->userSession->ping($tempUser, $params);

        /** @var JsonResponse $response */
        $response = $next($request);

        return $response;
    }
}
