<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ApiController extends Controller
{
    public function returnSuccess($message = '', $data = [])
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], 200);
    }
}
