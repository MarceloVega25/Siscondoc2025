<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyMail;
use Illuminate\Http\UploadedFile;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'body' => 'required|string',
            'attachment' => 'nullable|array',
            'attachment.*' => 'nullable|file|max:2048',
        ]);

        $email = $request->input('email');
        $subject = $request->input('subject');
        $body = $request->input('body');
        $attachment = $request->file('attachment');

        Mail::to($email)->send(new NotifyMail($subject, $body, $attachment));

        return back()->with('mensaje', 'Correo enviado con éxito.');
    }
}