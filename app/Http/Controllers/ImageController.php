<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
{
    // Validate the uploaded file
    $request->validate([
        'image' => 'required|image|max:2048', // max 2MB
    ]);

    // Store the image in storage/app/public/uploads folder
    $path = $request->file('image')->store('uploads', 'public');

    // You can now save the $path (e.g., 'uploads/filename.jpg') to your database

    return back()->with('success', 'Image uploaded successfully!');
}
    //
}
