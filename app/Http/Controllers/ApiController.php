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

    public function returnFail($message = '', $data = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], 400);
    }

    public function returnNotFound($message = 'not found', $data = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], 404);
    }
}
