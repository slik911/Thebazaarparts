<?php

namespace App\Console\Commands;

use App\Membership;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class deleteExpiredMembership extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deleteExpiredMembership';

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
        $current_date = Carbon::now();
        $silver_memberships = DB::table('memberships')->where('silver_expiry_date', '<=', $current_date)->get();
        foreach ($silver_memberships as $silver_membership) {
            $silver = Membership::where('id', $silver_membership->id)->first();
            $silver->silver = false;
            $silver->silver_expiry_date = null;
            $silver->save();
        }

        $platinum_memberships = DB::table('memberships')->where('platinum_expiry_date', '<=', $current_date)->cursor();
        foreach ($platinum_memberships as $platinum_membership) {
            DB::table('memberships')->where('id',  $platinum_membership->id)->update([
                'platinum'=>false,
                'platinum_expiry_date' => NULL,
            ]);
        }

        $gold_memberships = DB::table('memberships')->where('gold_expiry_date', '<=', $current_date)->cursor();
        foreach ($gold_memberships as $gold_membership) {
            DB::table('memberships')->where('id',  $gold_membership->id)->update([
                'gold'=>false,
                'gold_expiry_date' => NULL,
            ]);
        }
    }
}
