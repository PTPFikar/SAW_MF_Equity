@extends('layouts.auth')

@section('content')
  <main class="form-signin">
    <img class="mb-4" src="/assets/img/logo_saw.png" alt="SAW" width="300" height="196">
    <h1 class="h3 mb-3 fw-normal">Log In</h1>

    <form action="/" method="POST">
      @csrf

      <div class="form-floating">
        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="name@example.com" autocomplete="off" autofocus required>
        <label for="username">Username</label>

        @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-floating">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
        <label for="password">Password</label>

        @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      <p class="mt-3 mb-3 text-muted">&copy; UNBIN-11522023 2023</p>
    </form>
  </main>
@endsection