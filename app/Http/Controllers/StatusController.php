<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $data = [
            'user' => 'Alexa',
            'position' => 'Front-End Developer',
            'location' => 'Open Library Telkom University',
            'status' => 'Aktif',
        ];

        return view('status', compact('data'));
    }
}
