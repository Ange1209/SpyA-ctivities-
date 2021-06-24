<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div> --}}


    <div class="card w-100">

   
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nom</th>
                <th scope="col">Departement</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <tbody>
                @foreach ($users as $item)        
                <tr>
                  <td> {{$item->name}} </td>
                  <td>{{$item->department_id}} </td>
                  <td>{{$item->email}} </td>
                  <td><a href="" ><button class="btn btn-primary">Editer</button></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
