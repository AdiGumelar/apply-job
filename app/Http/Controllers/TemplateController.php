<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Templates;
use App\Models\Attachments;

class TemplateController extends Controller
{
    public function showEmails()
    {
        $templates = Templates::all();
        return response()->json(['data' => $templates]);
    }

    public function storeEmail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $saveTemplates = Templates::create([
            'user_id' => 1,
            'name' => $validatedData['name'],
            'subject' => $validatedData['subject'],
            'content' => $validatedData['content'],
        ]);

        return response()->json(['message' => 'Template berhasil disimpan.', 'data' => $saveTemplates], 201 );
    }

    public function setDefaultEmail($id)
    {
        Templates::where('user_id', 1)->update(['is_default' => false]);

        $template = Templates::findOrFail($id);
        $template->is_default = true;
        $template->save();

        return response()->json(['message' => 'Template berhasil dijadikan default.', 'data' => $template]);
    }

    public function destroyEmail($id)
    {
        $template = Templates::findOrFail($id);
        $template->delete();

        return response()->json(['message' => 'Template berhasil dihapus.']);
    }

    public function updateEmail(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $template = Templates::findOrFail($id);
        $template->name = $validatedData['name'];
        $template->subject = $validatedData['subject'];
        $template->content = $validatedData['content'];
        $template->save();

        return response()->json(['message' => 'Template berhasil diperbarui.', 'data' => $template]);
    }

    public function storeCoverLetter(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $path = $request->file('file')->store('lampiran', 'public');

        $name = $validatedData['file']->getClientOriginalName();

        $saveAttachments = Attachments::create([
            'user_id' => 1,
            'name' => $name,
            'type' => 'surat_lamaran',
            'file_path' => $path,
            'file_size' => $validatedData['file']->getSize(),
        ]);

        return response()->json(['message' => 'Template berhasil disimpan.', 'data' => $saveAttachments], 201 );
    }

    public function showCoverLetters()
    {
        $attachments = Attachments::where('type', 'surat_lamaran')->get();
        return response()->json(['data' => $attachments, 'message' => 'Template surat lamaran berhasil ditampilkan.']);
    }

    public function destroyCoverLetter($id)
    {
        $attachment = Attachments::findOrFail($id);
        $filePath = storage_path('app/public/' . $attachment->file_path);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $attachment->delete();

        return response()->json(['message' => 'Template surat lamaran berhasil dihapus.']);
    }

    public function setDefaultCoverLetter($id)
    {
        Attachments::where('user_id', 1)->where('type', 'surat_lamaran')->update(['is_default' => false]);

        $attachment = Attachments::findOrFail($id);
        $attachment->is_default = true;
        $attachment->save();

        return response()->json(['message' => 'Template surat lamaran berhasil dijadikan default.', 'data' => $attachment]);
    }

    public function downloadCoverLetter($id)
    {
        $attachment = Attachments::findOrFail($id);
        $filePath = storage_path('app/public/' . $attachment->file_path);

        if (!file_exists($filePath)) {
            return response()->json(['message' => 'File tidak ditemukan.'], 404);
        }

        return response()->download($filePath, $attachment->name);
    }
}
