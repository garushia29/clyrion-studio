<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Controller: MediaController (Admin)
 *
 * Endpoints para subida de archivos desde el editor Trix.
 */
class MediaController extends Controller
{
    public function uploadTrix(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,webp,svg|max:10240',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $name = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $storedName = time() . '_' . str_replace(' ', '_', $name) . '.' . $extension;

        $path = $file->storeAs('uploads', $storedName, 'public');

        Media::create([
            'name' => $name,
            'original_name' => $originalName,
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }
}
