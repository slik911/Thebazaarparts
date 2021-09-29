<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CompanyProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\ProductSlotManager;
use App\User;

class SellerController extends Controller
{
    public function updateSellerProfile(Request $request){
         
        if(DB::table('company_profiles')->where('user_id', auth::user()->id)->exists()){
            
            $prof = DB::table('company_profiles')->where('user_id', auth::user()->id)->first();

                    if($request->image){
                        File::delete('images/company_logo/'.$prof->logo);
                        ini_set('memory_limit', '2048M');
                        $this->validate($request,[
                            'image'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
                        ]);
                        $image = $request->file('image');
            
                        $filename = time() . '.' . 'jpg';
            
                        $location = public_path('images/company_logo/'. $filename);
            
                        Image::make($image->getRealPath())->resize(200, 200, function($constraint){
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })->encode('jpg', 0)->save($location);

                        DB::table('company_profiles')->where('user_id', auth::user()->id)->update([
                            "logo" => $filename,
                        ]);
                    }

            if($prof->name == $request->name && $prof->email != $request->email){
                DB::table('company_profiles')->where('user_id', auth::user()->id)->update([
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "description" => $request->description,
                    "address" => $request->address,
                    "business_type" => $request->business_type,
                    "website" => $request->website,
                    "status"=> true,
                    "verified" => false,
                    "completed" => true,
                ]);

              
            }
            else if($prof->name != $request->name && $prof->email == $request->email){
               
                DB::table('company_profiles')->where('user_id', auth::user()->id)->update([
                    "name" => $request->name,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "description" => $request->description,
                    "business_type" => $request->business_type,
                    "website" => $request->website,
                    "status"=> true,
                    "verified" => false,
                    "completed" => true,
               
                ]);

                $slug = CompanyProfile::where('user_id', auth::user()->id)->first();
                $slug->slug = null;
                $slug->save();
                }

                else if($prof->name == $request->name && $prof->email == $request->email){
                    DB::table('company_profiles')->where('user_id', auth::user()->id)->update([
                        "phone" => $request->phone,
                        "address" => $request->address,
                        "description" => $request->description,
                        "business_type" => $request->business_type,
                        "website" => $request->website,
                        "status"=> true,
                        "verified" => false,
                        "completed" => true,
                    ]);
                    
             }

             else{
                if(DB::table('company_profiles')->where('name', $request->name)->exists()){
                    $request->session()->flash('error', 'Name already exists');
                    return redirect()->back();
                }
                else if(DB::table('company_profiles')->where('email', $request->email)->exists()){
                    $request->session()->flash('error', 'Email already exists');
                    return redirect()->back();
                }
                else{
                 
                    DB::table('company_profiles')->where('user_id', auth::user()->id)->update([
                        "name" => $request->name,
                        "email" => $request->email,
                        "phone" => $request->phone,
                        "description" => $request->description,
                        "address" => $request->address,
                        "business_type" => $request->business_type,
                        "website" => $request->website,
                        "logo" => $filename,
                        "status"=> true,
                        "verified" => false,
                        "completed" => true,
                    ]);

                    $slug = CompanyProfile::where('user_id', auth::user()->id)->first();
                    $slug->slug = null;
                    $slug->save();

                    $request->session()->flash('success', 'Profile updated successfully');
                    return redirect()->back();
                }
            }

            

            $request->session()->flash('success', 'Profile updated successfully');
            return redirect()->back();
        }

        else{
            if($request->image){
                ini_set('memory_limit', '2048M');
                $this->validate($request,[
                    'image'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
                ]);
                $image = $request->file('image');
    
                $filename = time() . '.' . 'jpg';
    
                $location = public_path('images/company_logo/'. $filename);
    
                Image::make($image->getRealPath())->resize(200, 200, function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('jpg', 0)->save($location);
    
            }
    
            $profile = new CompanyProfile;
            $profile->user_id = auth::user()->id;
            $profile->name = $request->name;
            $profile->email = $request->email;
            $profile->phone = $request->phone;
            $profile->description = $request->description;
            $profile->address = $request->address;
            $profile->business_type = $request->business_type;
            $profile->website = $request->website;
            $profile->logo = $filename;
            $profile->status = true;
            $profile->completed = true;

            $profile->save();

            $request->session()->flash('success', 'Profile created successfully ');
                return redirect()->back();
        }
    }

    public function updateBuyerProfile(Request $request){
        if(DB::table('company_profiles')->where('name', $request->name)->exists()){
            $request->session()->flash('error', 'Company name already exists');
            return redirect()->back();
        }
        else if(DB::table('company_profiles')->where('email', $request->email)->exists()){
            $request->session()->flash('error', 'Email already exists');
            return redirect()->back();
        }
        else{
            $profile = new CompanyProfile;
            $profile->user_id = auth::user()->id;
            $profile->name = $request->name;
            $profile->email = $request->email;
            $profile->phone = $request->phone;
            $profile->description = $request->description;
            $profile->address = $request->address;
            $profile->business_type = $request->business_type;
            $profile->website = $request->website;
            $profile->status = true;

            if($request->image){
                $image = $request->file('image');
                $filename = time() . '.' . 'jpg';
                $location = public_path('images/company_logo/'. $filename);
                Image::make($image->getRealPath())->resize(200, 200, function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('jpg', 0)->save($location);
                $profile->logo = $filename;
            }
           
            $profile->save();

            $user = User::findorfail(auth::user()->id);
            $user->role = "seller";
            $user->save();

            $newSlot = new ProductSlotManager;
            $newSlot->slot_id = "".time().auth()->user()->id;
            $newSlot->user_id = $user->id;
            $newSlot->package = "Regular";
            $newSlot->total_slot_assigned = 5;
            $newSlot->total_slot_remaining = 5;
            $newSlot->start_time = null;
            $newSlot->end_time = null;
            $newSlot->save();

            if($profile && $user){
                $request->session()->flash('success', 'Your account has been updated to a seller and profile uploaded successfully');
                return redirect('home');
            }
        }
    }
       
}
