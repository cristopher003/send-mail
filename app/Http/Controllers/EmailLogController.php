<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EmailLog;

class EmailLogController extends Controller {
    public function index() {
        $logs = EmailLog::orderBy('created_at', 'desc')->paginate(10);
        return view('email_logs.index', compact('logs'));
    }
}
