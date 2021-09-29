<?php

namespace App\Jobs;

use App\Mail\ProductApproval;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProductApprovalMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     * 
     *
     * @return void
     */
    public $details;
    public $email;
  public function __construct($details, $email)
  {
      $this->details = $details;
      $this->email = $email;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
      Mail::to($this->email)->send(new ProductApproval($this->details));
  }
}
