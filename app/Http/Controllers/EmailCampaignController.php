<?php

namespace App\Http\Controllers;

use App\Models\EmailCampaign;
use App\Models\EmailTemplate;
use App\Models\UserList;
use App\Services\EmailService;
use App\Http\Requests\CreateEmailCampaignRequest;
use Illuminate\Http\Request;

class EmailCampaignController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function create()
    {
        $templates = EmailTemplate::all();
        $userLists = UserList::all();
        return view('email-campaigns.create', compact('templates', 'userLists'));
    }

    public function store(CreateEmailCampaignRequest $request)
    {
        $campaign = EmailCampaign::create($request->validated());
        
        // Dispatch job to send emails
        SendEmailCampaignJob::dispatch($campaign);

        return redirect()->route('campaigns.index')
            ->with('success', 'Campaña de email creada exitosamente');
    }

    public function sendCampaign(EmailCampaign $campaign)
    {
        $this->emailService->sendCampaign($campaign);
        
        return back()->with('success', 'Campaña enviada');
    }
}