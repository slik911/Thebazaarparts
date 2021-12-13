<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
        if(DB::table('users')->where('email', $email)->exists()){
        $user = User::where('email', $email)->first();
        $user->email_verified_at = Carbon::now();
        $user->save();
        }
    }

    public function change_community_password($email, $password){

        // return($email);
        if(DB::table('users')->where('email', $email)->exists()){
        $user = User::where('email', $email)->first();
        $user->password = Hash::make($password);
        $user->save();
        }
    }

    public function update_community_profile(Request $request, $email){
        if(DB::table('users')->where('email', $email)->exists()){
            $user = User::where('email', $email)->first();
            $user->name = $request->name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->save();
        }
    }

    public function search(Request $request){

        $categories = DB::table('categories')->where('deleted', false)->cursor();
        $q = $request->search;
        $search_values = preg_split('/\s+/', $q, -1, PREG_SPLIT_NO_EMPTY);

        $res = DB::table('products')
                        ->select('products.*', 'categories.name as category_name', 'subcategories.name as subcategory_name')
                        ->leftjoin('categories', 'categories.slug', '=', 'products.category_id')
                        ->leftjoin('subcategories', 'subcategories.slug', '=', 'products.subcategory_id')

                        ->where(function ($x) use($search_values){
                            foreach($search_values as $value){
                                $x->orWhere('products.name', 'like', '%'.$value.'%');
                                $x->orWhere('products.category', 'like', '%'.$value.'%');
                                $x->orWhere('products.brand', 'like', '%'.$value.'%');
                                $x->orWhere('products.subcategory', 'like', '%'.$value.'%');
                            }
                        })
                        ->where('products.status', true)->where('products.rejected', false)->where('products.deleted', false)->get()->toArray();



        $product_count = count($res);
        $products = $this->paginate($res);
        $title = $q;

        return view('products_api', compact('products', 'categories','title', 'product_count'))->withQuery($q);
    }

    public function paginate($items, $perPage = 16, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        return new LengthAwarePaginator($itemstoshow ,$total ,$perPage);
    }
}

