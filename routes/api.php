<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;

//Template Email routes
Route::get('/templatesEmail', [TemplateController::class, 'showEmails']);
Route::post('/templatesEmail', [TemplateController::class, 'storeEmail']);
Route::put('/templatesEmail/{id}/set-default', [TemplateController::class, 'setDefaultEmail']);
Route::delete('/templatesEmail/{id}', [TemplateController::class, 'destroyEmail']);
Route::put('/templatesEmail/{id}', [TemplateController::class, 'updateEmail']);

//Template Surat Lamaran routes
Route::post('/templatesCoverLetter', [TemplateController::class, 'storeCoverLetter']);