<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Response;

class Controller extends BaseController
{
    public function resourceNotFound(array $resource)
    {
        $response = [
            'status' => 'fail',
            'code' => 404,
            'data' => $resource
        ];
        return response()->json($response,Response::HTTP_NOT_FOUND);
    }
}
