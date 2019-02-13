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

    public function update(Request $request){
        $user = \App\User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->save($user);
        return redirect('welcome');
    }

}


?>