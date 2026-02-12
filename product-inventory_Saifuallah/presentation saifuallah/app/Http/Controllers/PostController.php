<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller  // <-- PERHATIKAN: extends Controller
{
    public function recent()
    {
        return response()->json([
            'success' => true,
            'message' => 'Route /posts/recent berjaya!',
            'task' => '#16 - Saifullah'
        ]);
    }
}