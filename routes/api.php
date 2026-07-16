<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Attachment;

//Template Email routes
Route::get('/templatesEmail', [TemplateController::class, 'showEmails']);
Route::post('/templatesEmail', [TemplateController::class, 'storeEmail']);
Route::put('/templatesEmail/{id}/set-default', [TemplateController::class, 'setDefaultEmail']);
Route::delete('/templatesEmail/{id}', [TemplateController::class, 'destroyEmail']);
Route::put('/templatesEmail/{id}', [TemplateController::class, 'updateEmail']);

//Template Surat Lamaran routes
Route::post('/templatesCoverLetter', [TemplateController::class, 'storeCoverLetter']);
Route::get('/templatesCoverLetter', [TemplateController::class, 'showCoverLetters']);
Route::delete('/templatesCoverLetter/{id}', [TemplateController::class, 'destroyCoverLetter']);
Route::put('/templatesCoverLetter/{id}/set-default', [TemplateController::class, 'setDefaultCoverLetter']);
Route::get('/templatesCoverLetter/{id}/download', [TemplateController::class, 'downloadCoverLetter']);

//Lampiran routes
Route::get('/attachments', [Attachment::class, 'showAttachments']);
Route::post('/attachments', [Attachment::class, 'storeAttachments']);
Route::delete('/attachments/{id}', [Attachment::class, 'destroyAttachments']);
Route::put('/attachments/{id}/set-default', [Attachment::class, 'setDefaultAttachment']);