<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NotificationModel extends Model
{
    public function notifiable(){
        $profile_count = DB::table('company_profiles')->where('verified', false)->where('status', true)->count();
        $verification_count = DB::table('verifications')->where('status', false)->count();
        $regular_approval = DB::table('products')->where('status', false)->where('rejected', false)->count();
        $featured_approval = DB::table('featured_products')->where('status', false)->where('rejected', false)->count();
        $hotlist_approval = DB::table('hotlist_products')->where('status', false)->where('rejected', false)->count();

        $total_count = $profile_count+$verification_count+$regular_approval+$featured_approval+$hotlist_approval;

        $data =[
            'profile_count' => $profile_count,
            'verification_count' => $verification_count,
            'regular_approval' => $regular_approval,
            'featured_approval' => $featured_approval,
            'hotlist_approval' => $hotlist_approval,
            'total_count' => $total_count,
        ];

        return $data;
    }

    public function productNotification(){
 
        $regular_approval = DB::table('products')->where('rejected', true)->count();
        $featured_approval = DB::table('featured_products')->where('rejected', true)->count();
        $hotlist_approval = DB::table('hotlist_products')->where('rejected', true)->count();

        $total_count = $regular_approval+$featured_approval+$hotlist_approval;

        $slot_data =[
            'regular_approval' => $regular_approval,
            'featured_approval' => $featured_approval,
            'hotlist_approval' => $hotlist_approval,
            'total_count' => $total_count,
        ];

        return $slot_data;
    }
}