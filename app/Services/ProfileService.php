<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public static function updateProfile($data){
        $profile = Auth::user();

        $profile->country = $data['country'];
        $profile->birthdate = $data['birthdate'];
        $profile->profile_completed = true;
        
        $profile->save();

        return $profile;
    }
}
?>