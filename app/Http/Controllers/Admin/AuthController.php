<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function showLogin()
    {
        $quotes = [];
        for($i=1; $i<=3; $i++)
        {
            array_push($quotes, Inspiring::quote());
        }

        return view('admin.auth.login')->with(['quotes' => $quotes]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'username.required' => 'Please enter username',
            'password.required' => 'Please enter password',
        ]);

        if ($validator->passes())
        {
            $username = $request->username;
            $password = $request->password;
            $remember_me = $request->has('remember_me') ? true : false;

            try
            {
                $user = User::where('email', $username)->first();

                if(!$user)
                    return response()->json(['error2'=> 'No user found with this username']);

                if($user->active_status == '0' && !$user->roles)
                    return response()->json(['error2'=> 'You are not authorized to login, contact HOD']);

                if(!auth()->attempt(['email' => $username, 'password' => $password], $remember_me))
                    return response()->json(['error2'=> 'Your entered credentials are invalid']);

                $userType = '';
                if( $user->hasRole(['User']) )
                    $userType = 'user';

                return response()->json(['success'=> 'login successful', 'user_type'=> $userType ]);
            }
            catch(\Exception $e)
            {
                DB::rollBack();
                Log::info("login error:". $e);
                return response()->json(['error2'=> 'Something went wrong while validating your credentials!']);
            }
        }
        else
        {
            return response()->json(['error'=>$validator->errors()]);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
            'dob' => 'required|date',
            'age' => 'required|numeric',
            'username' => 'required|string',
            'citizenType' => 'required|string',
            'password' => 'required', 
            'confirmPassword' => 'required', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        // User registration logic
        $user = User::create([
            'name' => $request->fullname,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'mobile' => $request->mobile ?? '',
            'dob' => $request->dob,
            'age' => $request->age,
            'citizenType' => $request->citizenType,
            'username' => $request->username,
            'password' => Hash::make($request->password), 
            'role_id' => 8,
        ]);

        // Assign role to the user
        DB::table('model_has_roles')->insert([
            'role_id' => 8, 
            'model_type' => 'App\Models\User',
            'model_id' => $user->id
        ]);

        return response()->json([
            'success' => 'User registered successfully!',
            'user' => $user
        ], 201);
    }

    

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }


    public function showChangePassword()
    {
        return view('admin.auth.change-password');
    }


    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->passes())
        {
            $old_password = $request->old_password;
            $password = $request->password;

            try
            {
                $user = DB::table('users')->where('id', $request->user()->id)->first();

                if( Hash::check($old_password, $user->password) )
                {
                    DB::table('users')->where('id', $request->user()->id)->update(['password'=> Hash::make($password)]);

                    return response()->json(['success'=> 'Password changed successfully!']);
                }
                else
                {
                    return response()->json(['error2'=> 'Old password does not match']);
                }
            }
            catch(\Exception $e)
            {
                DB::rollBack();
                Log::info("password change error:". $e);
                return response()->json(['error2'=> 'Something went wrong while changing your password!']);
            }
        }
        else
        {
            return response()->json(['error'=>$validator->errors()]);
        }
    }

}
