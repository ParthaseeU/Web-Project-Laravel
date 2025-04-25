@extends('layouts.guest')

@section('title', 'School Website')
@section('meta', 'Authentication Page for the school website of ABC academy')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/authentication/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/authentication/cardContainer.css') }}">
@endsection

@section('content')
    <div class="card-snap-wrapper">
        {{-- Card Container --}}
        <x-CardContainer />

        {{-- Login Form --}}
        <div id="main-wrapper" class="roundBorder-15">
            <div id="form-wrapper">
                <h1>Sign In</h1>

                <form id="login-form" action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group">
                        Email: <input id="login-email" class="input-box" type="email" name="email" required
                            autocomplete="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        Password: <input id="login-password" class="input-box" type="password" name="password" required
                            value="{{ old('password') }}">
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <button id="loginSubmit-button" type="submit" class="indigoTheme roundBorder" form="login-form">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
