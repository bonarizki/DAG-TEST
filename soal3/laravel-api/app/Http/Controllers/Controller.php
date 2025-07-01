<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function index()
    {
        // This method can be overridden in child controllers
        return response()->json(['message' => 'Welcome to the API']);
    }
}
