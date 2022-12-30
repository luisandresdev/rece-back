<?php

namespace App\Http\Controllers;

use App\Http\Requests\profile\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\profile\UpdateProfileRequest;


class ProfileController extends Controller
{
    // Obtener el perfil del usuario
    public function show()
    {
        return response()->json(['data' => auth()->user()], Response::HTTP_OK);
    }


    // Editar el perfil del usuario
    public function update(UpdateProfileRequest $request)
    {

        $data = $request->only(['name', 'email']);

        $user = auth()->user();
        $user->name = $data['name'];
        $user->email = $data['email'];

        $user->save();

        return response()->json(['data' => $user], Response::HTTP_OK);
    }

    // cambiar contraseña
    public function changePassword(ChangePasswordRequest $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['data' => $user], Response::HTTP_OK);
    }
}
