@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-info">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Resend Verification Email</button>
    </form>

    <a href="{{ route('logout') }}" class="btn btn-danger">Log Out</a>
</div>
@endsection
