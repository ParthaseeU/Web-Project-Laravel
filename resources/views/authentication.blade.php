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
            <div id="callToAction-wrapper" class="registrationCTA">
                <x-CallToAction />
            </div>

            <div id="form-wrapper">
                <h1>Sign In</h1>

                <form id="login-form" action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group">
                        Email: <input id="login-email" class="input-box" name="login-email" required autocomplete="on"
                            value="{{ old('login-email') }}">
                        @error('login-email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        Password: <input id="login-password" class="input-box" type="login-password" name="password"
                            required value="{{ old('login-password') }}">
                        @error('login-password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <button id="loginSubmit-button" type="submit" class="indigoTheme roundBorder" form="login-form">
                        Submit
                    </button>
                </form>

                <form id="registration-form" action="{{ route('register') }}" method="post">
                    @csrf
                    <fieldset id="generalAttr-fieldset" style="border: none; margin-left: 2em; gap: 5px;">
                        <div class="input-group">
                            <label for="name" class="text-label">Name</label>
                            <input id="name" class="input-box hover transparent-placeholder" type="text"
                                name="name" placeholder="Name" required value="{{ old('name') }}">
                            @error('name')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="email" class="text-label">Email</label>
                            <input id="email" class="input-box hover transparent-placeholder" type="email"
                                name="email" placeholder="Email" required autocomplete="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label>Gender</label>
                            <select id="gender" class="input-box hover transparent-placeholder" name="gender" required>
                                <option> </option>
                                <option value="M" {{ old('gender') == 'M' ? 'selected' : '' }}> Male </option>
                                <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}> Female </option>
                            </select>
                            @error('gender')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label>Date of Birth</label>
                            <input id="date-of-birth" class="input-box hover transparent-placeholder" type="date"
                                required name="date_of_birth" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label>Password</label>
                            <input id="password" class="input-box hover transparent-placeholder" type="password" required
                                name="password" pattern="(?=.*[A-Z])(?=.*\d).{5,}" minlength="5">
                            @error('password')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="admin input-group">
                            <label>Date Joined</label>
                            <input id="admin-date-joined" class="input-box hover transparent-placeholder"
                                name="admin_date_joined" type="date" required value="{{ old('admin_date_joined') }}">
                            @error('admin_date_joined')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </fieldset>

                    <button type="submit" id="registrationSubmit-button" class="indigoTheme roundBorder">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
