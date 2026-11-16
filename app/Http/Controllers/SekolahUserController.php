<?php

namespace App\Http\Controllers;

use App\Models\OldUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SekolahUserController extends Controller
{
    public function user()
    {
        return view('sekolah.user', [
            'page' => 'user'
        ]);
    }

    public function updateUser()
    {
        $user = auth()->user();


        $attributes = request()->validate([
            'old_password' => 'required',
            'new_password' => 'required'
        ]);

        if (Hash::check($attributes['old_password'], $user->password)) {

            $password = Hash::make($attributes['new_password']);


            $test = User::find($user->id);
            $test->password = $password;
            $test->save();

            OldUser::where('users_id', $user->id)->delete();

            $user->password = $password;
            return redirect()->back();
        }

        throw ValidationException::withMessages([]);
    }
}
