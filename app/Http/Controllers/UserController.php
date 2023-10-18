<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
   public function index()
   {
      return \view('profiel.index');
   }

   // public function update(Request $request)
   // {
   //    $user = User::find(Auth::user()->id);
   //    if ($request->hasFile('foto')) {
   //       // if($user->foto != 'user.png'){
   //       //    Storage::delete($user->foto);
   //       // }
   //       $imagePath = $request->file('foto')->store('profiel');
   //       User::where('id', $user->id)->update([
   //          'name' => $request->name,
   //          'email' => $request->email,
   //          'foto' => $imagePath
   //       ]);
   //    } else {
   //       User::where('id', $user->id)->update([
   //          'name' => $request->name,
   //          'email' => $request->email
   //       ]);
   //    }

   //    return \redirect('/user')->with('alert', 'Profil berhasil diupdate');
   // }
   public function update(Request $request)
{
   $user = User::find(Auth::user()->id);

   // Menyimpan nama file foto sebelumnya
   $previousFoto = $user->foto;

   if ($request->hasFile('foto')) {
      // Validasi ekstensi file yang diunggah
      $this->validate($request, [
         'foto' => 'image|mimes:jpeg,png,jpg|max:1048', // Sesuaikan ekstensi dan ukuran maksimum sesuai kebutuhan
      ]);

      if ($previousFoto != 'user.png') {
         // Hapus file foto terdahulu jika bukan 'user.png'
         Storage::delete($previousFoto);
      }

      $imagePath = $request->file('foto')->store('profiel');
      User::where('id', $user->id)->update([
         'name' => $request->name,
         'email' => $request->email,
         'foto' => $imagePath
      ]);
   } else {
      User::where('id', $user->id)->update([
         'name' => $request->name,
         'email' => $request->email
      ]);
   }

   return \redirect('/user')->with('alert', 'Profil berhasil diupdate');
}


   public function rubahPassword(Request $request)
   {
     $validateData = $request->validate([
      'password_lama' => 'required',
      'password_baru' => 'required|min:8',
      'password_konfirmasi' => 'required|min:8|same:password_baru'
     ]);
     $user = Auth::user();

    // Memeriksa apakah kata sandi saat ini cocok dengan yang ada di database
    if (Hash::check($request->password_lama, $user->password)) {
        // Mengganti kata sandi jika cocok
        $user->update([
            'password' => Hash::make($request->password_konfirmasi),
        ]);

        return redirect('/user')->with('alert', 'Kata sandi berhasil diubah.');
    }
   }
}
