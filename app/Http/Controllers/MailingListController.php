<?php

namespace App\Http\Controllers;
use App\Models\MailingList;
use App\Models\User;

class MailingListController extends Controller {

    public function index() {
        $lists = MailingList::with('users')->get();
        return view('mailing-lists.index', compact('lists'));
    }

    public function create() {
        $users = User::all();
        return view('mailing-lists.create', compact('users'));
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|string', 'users' => 'required|array']);
        $list = MailingList::create(['name' => $request->name]);
        $list->users()->attach($request->users);
        return redirect()->route('mailing-lists.index');
    }
}

