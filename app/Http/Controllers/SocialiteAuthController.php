<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Hash;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Str;
use Auth;

class SocialiteAuthController extends Controller
{
    //
    public function providerLogin($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function providerAuthentication($provider){
        $providerUser = Socialite::driver($provider)->user();
        $member = Member::updateOrCreate([
            'email' => $providerUser->email,
        ], [
            'fullname' => $providerUser->name,
            'avatar' => $providerUser->avatar,
            'provider_id' => $providerUser->id,
            'provider_name' => $provider,
            'password' => Hash::make(Str::random(10)),
        ]);
        Auth::guard('members')->login($member);

        return redirect(route('home'));
    }
}
