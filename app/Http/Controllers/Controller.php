<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function sendSuccess($routeName, $data = null, $message = null, $param = null)
    {
        $response = [
            'data' => $data,
            'msg' => $message,
        ];

        return redirect()->route($routeName, $param)->with('response', $response);
    }

    protected function sendError($routeName, $userMessage = null, $internalMessage = null, $param = null)
    {
        $error = [
            'userMsg' => $userMessage,
            'internalMsg' => $internalMessage
        ];

        return redirect()->route($routeName, $param)->with(['error' => $error]);
    }

    protected function apiSendSuccess($data = null, $statusCode = Response::HTTP_OK, $message = null)
    {
        $response = [
            'data' => $data,
            'msg' => $message,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * user message (message trả về cho user)
     * internal message (message trả vể cho backend developer)
     * code (message trả về cho client developer)
     *
     * @param null $code
     * @param int $statusCode
     * @param null $userMessage
     * @param null $internalMessage
     * @param null $response
     * @return \Illuminate\Http\JsonResponse
     */
    protected function apiSendError($code = null, $statusCode = Response::HTTP_BAD_REQUEST, $userMessage = null, $internalMessage = null, $response = null)
    {
        $error = [
            'code' => $code,
            'userMsg' => $userMessage,
            'internalMsg' => $internalMessage,
            'response' => $response,
        ];

        return response()->json($error, $statusCode);
    }
}
