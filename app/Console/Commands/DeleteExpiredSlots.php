<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use  Illuminate\Support\Facades\File;
use Carbon\Carbon;
class DeleteExpiredSlots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendExpirationReminder';

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

        $product_slot_managers = DB::table('product_slot_managers')->whereDate('end_time','<=', $current_date)->cursor();

        foreach($product_slot_managers as $slot){

            $products = DB::table('products')->where('slot_id', $slot->slot_id)->cursor();
            foreach($products as $product){
                File::delete('images/products/'.$product->image);
                DB::table('products')->where('id', $product->id)->delete();
            }

            $hotlist_products = DB::table('hotlist_products')->where('slot_id', $slot->slot_id)->cursor();
            foreach($hotlist_products as $hotlist_product){
                File::delete('images/products/'.$hotlist_product->image);
                DB::table('hotlist_products')->where('id', $hotlist_product->id)->delete();
            }

            $featured_products = DB::table('featured_products')->where('slot_id', $slot->slot_id)->cursor();

            foreach($featured_products as $featured_product){
                File::delete('images/products/'.$featured_product->image);
                DB::table('featured_products')->where('id', $featured_product->id)->delete();
            }

            DB::table('product_slot_managers')->where('id', $slot->id)->delete();
        }


    }
}
