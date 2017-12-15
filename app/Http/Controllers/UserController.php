<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);

        return view('user/profile', compact('user'));
    }

    public function api_show()
    {
      $user = User::all();
      return response()->json($user, 200);
    }


}
