<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $path = $request->file('uploaded_file')->store('images');

        return response([
            'location' => url('img') . '/' . basename($path)
        ]);
    }
}

