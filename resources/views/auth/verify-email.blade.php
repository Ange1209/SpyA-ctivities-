{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout> --}}


@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card notice">
                    <div class="logo">
                        <img src="{{asset('images/logo.png')}}" alt="" class="img-fluid">
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="notice-text">
                            <h5>Un nouveua lien a été envoyer à l'adresse mail que vous avez fournis lors de l'inscription</h5>
                        </div>
                    @endif

                    <div class="notice-text">
                        <h6>Avant de commencer pouvez verifier votre adress mail en cliquant sur le lien que nous vous avons envoyé? Si vous n'avez pas recu de mail nous vous enverrons volontier un autre.</h6>
                    </div>
            
                    {{-- @if (session('status')) --}}
                    {{-- @dump('ok') --}}
                    {{-- <div class="notice-text">
                        <h5>Un nouveua lien a été envoyer à l'adresse mail que vous avez fournis lors de l'inscription</h5>
                    </div> --}}
                    {{-- @endif --}}

                    <div class="notice-form mt-2">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn reg-btn">
                                {{ __('Renvoyer') }}
                            </button>
                        </form>
                        
                        {{-- <h5><a class="mt-2" href="/">
                            {{ __('Quitter') }}
                           </a></h5> --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
            
                            <button type="submit" class="btn reg-btnn">
                                {{ __('Quitter') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection