<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthSignInRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function index()
  {
    $data = [
      'title' => 'Sign In',
    ];

    return view('auth.signin', $data);
  }

  public function authenticate(AuthSignInRequest $request)
  {
    $credentials = $request->validated();

    // Auth User Log In
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->intended('/dashboard');
    }

    // Log In Fail
    return back()->with('failed', "Sign In Failed, Please Try Again");
  }

  public function signOut(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'You Have Been Logged Out!');
  }
}
