<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachments;

class Attachment extends Controller
{

    public function showAttachments()
    {
        $attachments = Attachments::orderBy('created_at', 'desc')->paginate(10);
        return response()->json($attachments);
    }

    public function storeAttachments(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:CV,Portfolio,Certificate,Transcript,Other',
            'file' => 'required|file|max:2048', 
        ]);

        $path = $request->file('file')->store('lampiran', 'public');

        $name = $validatedData['file']->getClientOriginalName();

        $saveAttachments = Attachments::create([
                'user_id' => 1,
                'name' => $name,
                'type' => $validatedData['type'],
                'is_default' => $request->boolean('isDefault'),
                'file_path' => $path,
                'file_size' => $validatedData['file']->getSize(),
            ]);

        return response()->json(['message' => 'Lampiran berhasil disimpan.', 'data' => $saveAttachments], 201);
    }
}
