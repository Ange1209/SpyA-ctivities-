{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-12 col-md-8">
            <div class="auth-box">
                <div class="forget-form ">
                    <div class="card auth-card">
                        <div class="logo">
                            <img src="{{asset('images/logo.png')}}" alt="" class="img-fluid">
                        </div>
                        <div class="form">
                            <h5>{{ __('Entrez votre nouveau mot de passe') }}</h5><br>
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                 <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <div class="form-group w-100 mb-3">
                                    <div class="input-div">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $request->email) }}" required autocomplete="email">
                                        
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="email" class="form-label">{{ __('E-Mail') }}</label>
                                    </div>
                                </div>

                                <div class="form-group w-100 mb-3">
                                    
                                    <div class="input-div">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                                    </div>
                                </div>
            
                                <div class="form-group w-100 mb-3">
                                    
                                    <div class="input-div">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        <label for="password-confirm" class="form-label">{{ __('Confirmer le mot de passe') }}</label>
                                    </div>
                                </div>
                              
                                <div class="form-group row mb-3">
                                    <div class="col-md-12 auth-btn ">
                                        <div class="">
                                            <button type="submit" class="btn reg-btn">
                                                {{ __('Valider') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection