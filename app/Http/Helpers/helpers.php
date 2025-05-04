<?php

if (! function_exists('entityResponse')) {
    function entityResponse($data = null, $statusCode = 200, $status = 'success', $message = null)
    {
        $payload = ['status' => $status, 'statusCode' => $statusCode, 'data' => $data];
        if ($message) {
            $payload['message'] = $message;
        }

        return response($payload, $statusCode);
    }
}
