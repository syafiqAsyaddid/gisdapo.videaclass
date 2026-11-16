<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KcdProfilLembagaController extends Controller
{
    public function edit()
    {
        $profil = \App\Models\ProfilLembaga::first();
        return view('kcd.profil-lembaga', compact('profil'));
    }

    public function update(Request $request)
    {
        // dd($request->all()); 
        $data = $request->validate([
            'nama_lembaga' => 'required|string|max:255',
            'kode_lembaga' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'nama_pimpinan' => 'nullable|string|max:255',
            'nama_dinas_provinsi' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024', // Max 1MB
            
            // Wilayah API
            'province_id' => 'nullable|string',
            'city_id' => 'nullable|string',
            'district_id' => 'nullable|string',
            'village_id' => 'nullable|string',
            'city_name' => 'nullable|string',
            'district_name' => 'nullable|string',
            'kode_pos' => 'nullable|string',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);
        
        // dd('Passed Validation'); // Uncomment to debug if validation success

        $profil = \App\Models\ProfilLembaga::first();
        if (!$profil) {
            $profil = new \App\Models\ProfilLembaga();
        }

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($profil->logo && \Illuminate\Support\Facades\Storage::exists('public/' . $profil->logo)) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $profil->logo);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $path;
        }

        if ($request->hasFile('background_image')) {
            \Illuminate\Support\Facades\Log::info('Background image upload started.');
            // Delete old background image if exists
            if ($profil->background_image && \Illuminate\Support\Facades\Storage::exists('public/' . $profil->background_image)) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $profil->background_image);
            }
            $path = $request->file('background_image')->store('backgrounds', 'public');
            \Illuminate\Support\Facades\Log::info('Background image stored at: ' . $path);
            $data['background_image'] = $path;
        } else {
             \Illuminate\Support\Facades\Log::info('No background image file detected.');
        }

        $profil->fill($data);
        // dd($data, $profil->toArray()); // Removed debug
        $profil->save();
        
        \Illuminate\Support\Facades\Log::info('Profil saved. Background image in DB: ' . $profil->background_image);
        
        // Sync email to KCD Admin User (assuming there is a main admin user, likely ID 1 or identified by hak_akses_id = 3)
        // For simplicity, we update the current logged in user if they are admin, OR specific user logic if known.
        // Assuming the current user IS the admin managing this profile.
        if (auth()->check() && $request->email && auth()->user()->hak_akses_id == 3) { // KCD Admin
             $user = auth()->user();
             if($user->email !== $request->email) {
                 $user->email = $request->email;
                 $user->save();
             }
        }

        return redirect()->back()->with('success', 'Profil Lembaga berhasil diperbarui.');
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username,' . auth()->id(),
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = auth()->user();
        $user->username = $request->username;
        
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Akun admin berhasil diperbarui.');
    }
}
