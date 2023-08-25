<?php

namespace App\Http\Controllers;

use App\Helpers\UserSystemInfoHelper;
use App\Http\Requests\JoinRequest;
use App\Http\Requests\UserRequest;
use App\Mail\JoinMail;
use App\Models\Rank;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use Stevebauman\Location\Facades\Location;

class AuthController extends Controller
{
    //Login method
    public function Login(UserRequest $request){
        $ChackStatus = User::where('email',$request->email)->first();

        if(Hash::check($request->password, $ChackStatus->password)) {
            if($ChackStatus->status == 'active')
            {
                $UpdateAgentInfo = $ChackStatus->where('id',$ChackStatus->id)->updateinfo();
                if($UpdateAgentInfo){
                    Auth::attempt(['email'=>$request->email, 'password'=>$request->password,'status'=>'active']);
                }
            } else{
                return redirect()->back()->withErrors(['StatusError'=>'StatusError']);
            }
        } else{
            return redirect()->back()->withErrors(['PasswordError'=>'PasswordError']);

        }

        return Redirect::back()->withSuccess(['success']);

    }

    //Join method
    public function join(JoinRequest $request){


    $GetRankID = Rank::where('rank_name','عضو جديد')->first();
        if ($GetRankID){
            $rank_id = $GetRankID->id;
        } else {
            $rank_id = 0;
        }

        $RandomCode = Str::random(10);
        $Join= User::create([
            'name'=>$request->name,
            'email'=>$request->join_email,
            'password'=>Hash::make($request->join_password),
            'rank_id'=>$rank_id,
            'status'=>'active',
            'verify_code'=>$RandomCode
        ]);
        $Join->where('id',$Join->id)->updateinfo();

        if($request->signatures){
            Signature::create([
                'sign_name'=>$request->signatures,
                'font_family'=>$request->signatures_font_family,
                'text_color'=>$request->signatures_text_color,
                'user_id'=>$Join->id
            ]);
        }

        // if ($Join){
        //     Mail::to($request->join_email)->send(new JoinMail($Join->id,$request->join_email,$RandomCode));
        // }

        Session::flash('Join_success', "تم تسجيل الحساب بنجاح");
        return Redirect::route('join');

    }
}
