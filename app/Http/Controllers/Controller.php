<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successResponse($response, $httpStatus = 200)
    {
        // dump($response, $httpStatus);
        $response['status'] = 1;
        $response['data'] = (isset($response['data'])) ? $response['data'] : null;
        return response()->json($response, $httpStatus);
        // $response['status'] = 1;
        // $response['data'] = (isset($response['data'])) ? $response['data'] : null;
        // return ['data' => $response, 'httpStatus' => $httpStatus];
    }

    public function failureResponse($response, $httpStatus = 200)
    {
        $response['status'] = 0;
        $response['data'] = (isset($response['data'])) ? $response['data'] : null;
        return response()->json($response, $httpStatus);
        // $response['status'] = 0;
        // $response['data'] = (isset($response['data'])) ? $response['data'] : null;
        // return ['data' => $response, 'httpStatus' => $httpStatus];
    }
}
