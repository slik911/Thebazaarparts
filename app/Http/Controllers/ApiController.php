<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function save_community_data(Request $request){
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'address'=>$request->address,
            'phone'=>$request->phone,
        ]);
    }

    public function verify_community_user($email){

        // return($email);
        $user = User::where('email', $email)->first();
        $user->email_verified_at = Carbon::now();
        $user->save();
    }

    public function change_community_password($email, $password){

        // return($email);
        $user = User::where('email', $email)->first();
        $user->password = Hash::make($password);
        $user->save();
    }

    public function update_community_profile(Request $request, $email){
        $user = User::where('email', $email)->first();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();
    }

    public function search(Request $request){

        $categories = DB::table('categories')->where('deleted', false)->cursor();



        $q = $request->search;
        $search_values = preg_split('/\s+/', $q, -1, PREG_SPLIT_NO_EMPTY);

        $products = DB::table('products')
                        ->select('products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name')
                        ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
                        ->leftjoin('subcategories', 'subcategories.id', '=', 'products.subcategory_id')

                        ->where(function ($x) use($search_values){
                            foreach($search_values as $value){
                                $x->orWhere('products.name', 'like', '%'.$value.'%');
                            }
                        })
                        ->where('products.status', true)->where('products.rejected', false)->where('products.deleted', false)->paginate(16);



        $product_count = count($products);
        $title = $q;

        return view('products_api', compact('products', 'categories','title', 'product_count'))->withQuery($q);
    }
}
