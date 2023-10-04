<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    protected function setRes($status, $data, $code)
    {
        $json = [
            'status' => $status ? $status : false,
            'data' => $data ? $data : null,
            'code' => $code ? $code : 200,
        ];
        return response()->json($json);
    }
}
