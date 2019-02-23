<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$user = \App\User::where('id',Auth::user()->id)->first();
        // Creating a token without scopes...
        $token = $user->createToken('reset')->accessToken;*/

        return view('profile/index'/*,compact('token')*/);
    }

    public function show($id){
        return view('profile/index');
    }

    public function update($id, Request $request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
        //flash('Su perfil ha sido actualizada');
        return redirect()->back()->with("success_profile","El perfil ha sido cambiado con éxito.");
    }

    public function updatePassword(Request $request){
        if(strcmp($request->get('password'), $request->get('password_confirmation')) != 0){
            //Current password and new password are same
            return redirect()->back()->with("error_password","Las contraseñas deben ser iguales.");
        }
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->back()->with("success_password","La contraseña ha sido cambiada con éxito.");
    }

}


?>