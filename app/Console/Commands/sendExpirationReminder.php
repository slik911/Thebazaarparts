<?php

namespace App\Console\Commands;

use App\Jobs\ExpirationReminderMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class sendExpirationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now();
        $datas = DB::table('product_slot_managers')->where('expired', false)->where('end_time', '!=', NULL)->where('expiry_notification', false);
        if($datas){
            foreach($datas->get() as $data){

            $slot = DB::table('product_slot_managers')->where('id', $data->id)->first();
            // dd($date->diffInDays(Carbon::parse($slot->end_time), false));
            if($date->diffInDays(Carbon::parse($slot->end_time), false) == 2){
                // dd("correct");
                $user = DB::table('users')->where('id', $data->user_id)->first();
                $details = [
                    'title' => 'Package Expiration',
                    'slot_id' => $data->slot_id,
                    'package' => $data->package,
                    'url' =>route('home'),
                    'date' => Carbon::parse($data->end_time)->format('d, M Y'),
                ];
                $email = $user->email;
                DB::table('product_slot_managers')->where('id', $data->id)->update(['expiry_notification'=>true]);
                //     Mail::to($email)->send(new ExpirationReminder($details));
                    ExpirationReminderMail::dispatch($details, $email)
                    ->delay(now()->addSeconds(10));
            }
        
            }
        }
    }
}
