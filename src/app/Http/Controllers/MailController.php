<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class MailController extends Controller
{
    public function create(User $user)
    {
        return view('emails.create', compact('user'));
    }
    public function send(Request $request, User $user)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $content = $request->input('content');
        Mail::to($user->email)->send(new ContactMail($content, $user));

        return redirect()->back()->with('success', 'メール送信が成功しました');
    }
    public function sendToAllForm()
    {
        return view('emails.send_to_all');
    }

    public function sendToAll(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $content = $request->input('content');
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new ContactMail($content, $user));
        }

        return redirect()->back()->with('success', 'メール送信が成功しました');
    }
}
