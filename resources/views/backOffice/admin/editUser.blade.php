<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <h2>{{ $user->name }}</h2>
        <h3>{{ $user->department_id}}</h3>
        <form method="POST" action="{{ route('editer', $user) }}">
            @csrf
            @method('PATCH')
            <div>
                <x-label for="role" :value="__('Role')" />
                
                <input id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" required autofocus />
            </div>
            <div>
                <x-label for="admin_action" :value="__('admin_action')" />
                
                <input id="admin_action" class="block mt-1 w-full" type="text" name="admin_action" :value="old('admin_action')" required autofocus />
            </div>
           

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Editer') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>