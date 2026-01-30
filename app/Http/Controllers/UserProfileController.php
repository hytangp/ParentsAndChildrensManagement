<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Exception;

class UserProfileController extends Controller
{
    public function edit(){
        try{
            return view('pages.profile.other_details_form');
        }catch(Exception $e){
            return view('pages.profile.other_details_form')->with([
                'error' => 'Something went wrong.'
            ]);
        }
    }

    public function update(UpdateProfileRequest $request){
        try{
            $profile = ProfileService::updateProfile($request->validated());

            if(!$profile){
                throw new Exception("Something went wrong.");
            }

            return redirect()->route('dashboard');
        }catch(Exception $e){
            return view('pages.profile.other_details_form')->with([
                'error' => 'Something went wrong.'
            ]);
        }
    }
}
