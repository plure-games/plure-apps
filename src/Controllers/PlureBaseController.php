<?php


namespace PlureGames\PlureApps\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class PlureBaseController extends Controller
{
    const CREATED = 201;
    const UPDATED = 200;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const NOT_ALLOWED = 405;
    const VALIDATION_ERROR = 422;
    const SERVER_ERROR = 500;
    const SUCCESS = 200;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($data = [], $code = self::SUCCESS, $message = ''): \Illuminate\Http\JsonResponse
    {
        $result = ['data' => $data];
        if (empty($message)) {
            $message = $this->messageByCode($code);
        }
        $result['message'] = $message;
        return response()->json($result)->setStatusCode($code);
    }

    private function messageByCode($statusCode)
    {
        switch ($statusCode) {
            case self::CREATED:
                return 'Created';
            case self::UPDATED:
                return 'Success';
            case self::UNAUTHORIZED:
                return 'Unauthorized';
            case self::FORBIDDEN:
                return 'Forbidden';
            case self::NOT_FOUND:
                return 'Not Found';
            case self::NOT_ALLOWED:
                return 'Method Not Allowed';
            default:
                return 'Whoops, looks like something went wrong';
        }
    }
}