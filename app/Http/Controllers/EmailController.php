<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\MailingList;
use App\Models\User;
use App\Jobs\SendEmailJob;

class EmailController extends Controller
{
    /**
     * Muestra el formulario para enviar correos.
     */
    public function showSendEmailForm()
    {
        $mailingLists = MailingList::all();
        $users = User::all();

        return view('emails.send', compact('mailingLists', 'users'));
    }

    /**
     * Maneja el envío de correos.
     */
    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
            'recipients' => 'required|array',
        ]);

        foreach ($request->recipients as $recipient) {
            if (str_starts_with($recipient, 'list:')) {
                // Enviar a lista
                $listId = substr($recipient, 5);
                $list = MailingList::findOrFail($listId);
                foreach ($list->users as $user) {
                    dispatch(new SendEmailJob($user->email, $request->subject, $request->message));
                }
            } elseif (str_starts_with($recipient, 'user:')) {
                // Enviar a usuario individual
                $userId = substr($recipient, 5);
                $user = User::findOrFail($userId);
                dispatch(new SendEmailJob($user->email, $request->subject, $request->message));
            }
        }

        return redirect()->back()->with('message', 'Emails en proceso de envío.');
    }
}
