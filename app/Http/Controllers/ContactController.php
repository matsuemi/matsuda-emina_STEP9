<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(ContactRequest $request)
    {
    Mail::to(env('ADMIN_EMAIL'))
        ->send(new ContactMail($request->validated()));

    return redirect()->route('products.index')
        ->with('success', 'お問い合わせを送信しました。');
    }
}