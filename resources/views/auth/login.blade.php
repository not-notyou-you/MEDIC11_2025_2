@extends('layouts.auth')

@section('content')
<h2 class="login-title">Login</h2>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Log In</button>
</form>
<a href="/" class="back-button">← Back to Home</a>
@endsection
