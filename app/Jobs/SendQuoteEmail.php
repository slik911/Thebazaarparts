<?php

namespace App\Jobs;

use App\Mail\GetQuoteMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendQuoteEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $details;
    public $email;
    public $company_email;
    public function __construct($details, $email, $company_email)
    {
        $this->details = $details;
        $this->email = $email;
        $this->company_email = $company_email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->company_email)->send(new GetQuoteMail($this->details, $this->email));
    }
}
