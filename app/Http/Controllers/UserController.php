<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Komda;
use App\Models\KomdaUser;
use App\Models\Pengurus;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        /// mengambil data terakhir dan pagination 5 list
    $users = User::latest()->paginate(5);

    return view('user.index',compact('users'));

    }

    public function komda()
    {
        $komda = Komda::latest()->paginate(5);

        return view('komda.index',compact('komda'));
    }

    public function createKomda()
    {
        // $users = User::whereDoesntHave('roles')->get();
        return view('komda.create');
    }

    public function storeKomda(Request $request)
    {
        Komda::create([
           'name' => $request->name,
           'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('komda.index');
    }

    public function editKomda($id)
    {
        $komda = Komda::find($id);

        return view('komda.edit', ['komda' => $komda]);
    }

    public function updateKomda(Request $request, $id)
    {
        $komda = Komda::find($id);

        $komda->name = $request->name;
        $komda->deskripsi = $request->deskripsi;
        $komda->save();

        return redirect()->route('komda.index');
    }

    public function destroyKomda($id)
    {
        $komda = Komda::find($id);
        $komda->delete();

        return redirect()->route('komda.index');
    }

    public function userKomda()
    {
        $users = User::role('komda')->latest()->paginate(5);
        return view('user.index-user-komda',compact('users'));
    }

    public function createUserKomda()
    {
        $komda = Komda::get();

        return view('user.create-user-komda', ['komda' => $komda]);
    }

    public function storeUserKomda(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        KomdaUser::create([
           'user_id' => $user->id,
           'komda_id' => $request->komda_id
        ]);

        $user->assignRole('komda');

        return redirect()->route('user-komda');
    }

    public function editUserKomda($id)
    {
        $user = User::with('komda_user')->find($id);

        $komda = Komda::get();
        //  return response()->json($user);
        return view('user.edit-user-komda', ['user' => $user, 'komda' => $komda]);
    }

    public function updateUserKomda(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? bcrypt($request->password) : $user->password;
        $user->save();

        if (!empty($request->komda_id)) {
            if (!empty($user->komda_user)) {
                $komdaUser = KomdaUser::find($user->komda_user->id);
                $komdaUser->komda_id = $request->komda_id;
                $komdaUser->save();
            }else{
                KomdaUser::create([
                    'user_id' => $user->id,
                    'komda_id' => $request->komda_id
                ]);
            }
        }

        return redirect()->route('user-komda');
    }

    public function destroyUserKomda($id)
    {
        $user = User::find($id);

        $user->removeRole('komda');

        $user->delete();

        return redirect()->route('user-komda');
    }

    public function pengurusKomda()
    {
        $useAuth = Auth::user();

        $userKomda = User::with('komda_user.komda')->find($useAuth->id);

        $user = User::with(['pengurus.komda'])
        ->whereHas('pengurus', function($data) use($userKomda){
           $data->whereHas('komda', function($query) use($userKomda){
                 if ($userKomda->komda_user && $userKomda->komda_user->komda->id) {
                    $query->where('id', '=', $userKomda->komda_user->komda->id);
                 }
            });
        })->role('pengurus')->latest()->paginate(5);

        return view('pengurus.index', ['users' => $user]);
    }

    public function createPengurusKomda()
    {
        $useAuth = Auth::user();

        $userKomda = User::with('komda_user.komda')->find($useAuth->id);

        $user = User::whereDoesntHave('roles')->get();
        $komda = Komda::where('id', $userKomda->komda_user->komda->id)->get();

        return view('pengurus.create', ['user' => $user, 'komda' => $komda]);
    }

    public function storePengurusKomda(Request $request)
    {
        Pengurus::create([
             'jabatan' => $request->jabatan,
             'user_id' => $request->user_id,
             'komda_id' => $request->komda_id
        ]);
        $user = User::find($request->user_id);
        $user->assignRole('pengurus');

        return redirect()->route('pengurus-komda');
    }

    public function editPengurusKomda($id)
    {
        $useAuth = Auth::user();

        $userKomda = User::with('komda_user.komda')->find($useAuth->id);
        $user = User::whereDoesntHave('roles')->get();
        $komda = Komda::where('id', $userKomda->komda_user->komda->id)->get();

        $pengurus = Pengurus::with('komda')->find($id);
        $pengurus['user'] = User::find($pengurus->user_id);
        // return response()->json($pengurus);
        return view('pengurus.edit', ['pengurus' => $pengurus, 'user' => $user, 'komda' => $komda]);
    }

    public function updatePengurusKomda(Request $request, $id)
    {
        $pengurus = Pengurus::find($id);
        $user = User::find($pengurus->user_id);
        $user->removeRole('pengurus');

        $pengurus->jabatan = $request->jabatan;
        $pengurus->user_id = $request->user_id;
        $pengurus->komda_id = $request->komda_id;
        $pengurus->save();

        $user = User::find($pengurus->user_id);
        $user->assignRole('pengurus');

        return redirect()->route('pengurus-komda');
    }

    public function destroyPengurusKomda($id)
    {
        $pengurus = Pengurus::find($id);
        $user = User::find($pengurus->user_id);
        $user->removeRole('pengurus');
        $pengurus->delete();

        return redirect()->route('pengurus-komda');
    }

    public function anggotaKomda()
    {
        $useAuth = Auth::user();

        $userKomda = User::with('komda_user.komda')->find($useAuth->id);

        $user = User::with(['anggota.komda'])
        ->whereHas('anggota', function($data) use($userKomda){
           $data->whereHas('komda', function($query) use($userKomda){
                 if ($userKomda->pengurus && $userKomda->pengurus->komda_id) {
                    $query->where('id', '=', $userKomda->pengurus->komda_id);
                 }
            });
        })->role('anggota')->latest()->paginate(5);

        //  return response()->json($user);
        return view('anggota.index', ['users' => $user]);
    }

    public function createAnggotaKomda()
    {
        $useAuth = Auth::user();
        $pengurus = Pengurus::where('user_id', $useAuth->id)->first();

        $user = User::whereDoesntHave('roles')->get();

        if ($pengurus) {
            $komda = Komda::where('id', $pengurus->komda_id)->get();
        }else{
            $komda = Komda::get();
        }

        return view('anggota.create', ['user' => $user, 'komda' => $komda]);
    }

    public function storeAnggotaKomda(Request $request)
    {
        // Anggota::create([
        //      'user_id' => $request->user_id,
        //      'komda_id' => $request->komda_id
        // ]);
        // $user = User::find($request->user_id);
        // $user->assignRole('anggota');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('anggota');

        Anggota::create([
            'user_id' => $user->id,
            'komda_id' => $request->komda_id
        ]);

        // return response()->json($request->all());
        return redirect()->route('anggota-komda');
    }

    public function editAnggotaKomda($id)
    {
       $useAuth = Auth::user();
       $pengurus = Pengurus::where('user_id', $useAuth->id)->first();
       $komda = Komda::where('id', $pengurus->komda_id)->get();

       $user = User::with('anggota.komda')->find($id);

       return view('anggota.edit', ['user' => $user, 'komda' => $komda]);
    }

    public function updateAnggotaKomda(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? bcrypt($request->password) : $user->password;
        $user->save();

        $anggota = Anggota::find($user->anggota->id);
        $anggota->komda_id = $request->komda_id;
        $anggota->save();

        return redirect()->route('anggota-komda');
    }

    public function destroyAnggotaKomda($id)
    {
        $user = User::find($id);
        $anggota = Anggota::find($user->anggota->id);
        $anggota->delete();
        $user->removeRole('anggota');
        $user->delete();

        return redirect()->route('anggota-komda');
    }
}
