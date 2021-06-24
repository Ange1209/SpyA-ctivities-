
@extends('layouts.app')

@section('content')

<div class="container">
    <div>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (session('erreur'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('erreur') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div> 
{{-- 
    {{dd($users)}} --}}
    <div id="manager-dash">
        <div class="row justify-content-center">
               <div class="col-12 col-md-4">
                    <div class="card emp-b">
                        <div class="img-p">
                            <div class="icon-b">
                                <img src="{{asset('images/ask.png')}}" alt="" class="my-img">
                            </div>
                        </div>
                        <div class="info-b">
                            <div class="title">
                                <h5>Demandes</h5>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>En attente de validation</p>
                                </div>
                                <div class="count">
                                    {{$validation->count()}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>En cours</p>
                                </div>
                                <div class="count">
                                    {{$enCours->count()}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>Total</p>
                                </div>
                                <div class="count">
                                    {{$demandes->count()}}
                                </div>
                            </div>
                            <div class="title" >
                                <a href="{{ route('showAllAsk') }}">Plus de detatils</a>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="col-12 col-md-4">
                    <div class="card emp-b">
                        <div class="img-p">
                            <div class="icon-b">
                                <img src="{{asset('images/hand.png')}}" alt="" class="my-img">   
                            </div>
                        </div>
                        <div class="info-b">
                            <div class="title"  >
                                <h5>Bonus</h5>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>Déclarations</p>
                                </div>
                                <div class="count">
                                    {{$declaration->count()}}
                                </div>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>Bonus attribués</p>
                                </div>
                                <div class="count">
                                    {{-- {{$declaration->count()}} --}} 5
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>Total</p>
                                </div>
                                <div class="count">
                                    20
                                </div>
                            </div>
                            
                            <div class="title" >
                                <a href="{{ route('depBonus') }}">Plus de detatils</a>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="col-12 col-md-4">
                    <div class="card emp-b">
                        <div class="img-p">
                            <div class="icon-b">
                                <img src="{{asset('images/team.png')}}" alt="" class="my-img">   
                            </div>
                        </div>

                        <div class="info-b">
                            <div class="title" >
                                <h5>Employés</h5>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>En attente d'activation</p>
                                </div>
                                <div class="count">
                                    {{$activation->count()}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>Bloquer</p>
                                </div>
                                <div class="count">
                                    0
                                    {{-- {{$bloquer->count()}} --}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>Total</p>
                                </div>
                                <div class="count">
                                    {{$users->count()}}
                                </div>
                            </div>
                            <div class="title" >
                                <a href="{{ route('employe') }}">Plus de detatils</a>
                            </div>
                        </div>
                    </div>
               </div>
        </div>
        
        <div class="row justify-content-center">
                <div class="col-12 col-md-12">
                    <div class="card new-list">
                        <div class="title-ban">
                            <h3>Nouveaux inscrits</h3>                        
                        </div>

                        {{-- @if ($users->count() <= 0 )
                            
                            @else
                            @endif --}}
                        @if ($activation->count() == 0)
                            <h4 class="text-center mt-5 mb-5">
                                Aucune nouvelle inscription
                            </h4>     
                        @else
                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <b>Nom</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>Role</b></th>
                                        <th><b>Statut</b></th>
                                        <th><b>Voir</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activation as $item)
                                        <tr>
                                            <td class="text-capitalize">{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td class="text-capitalize">{{$item->role}}</td>
                                            <td> 
                                                <div class=" stat-p">
                                                    <img src="{{asset('images/watch.png')}}" alt="" class="my-img">                                          
                                                </div>
                                            </td>
                                            <td>
                                                <div class="voir">
                                                    <a href="{{ route('show', $item->uuid) }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                                                </div> 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> <b>Nom</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>Role</b></th>
                                        <th><b>Statut</b></th>
                                        <th><b>Voir</b></th>
                                    </tr>
                                </tfoot>
                            </table>  
                        @endif    
                            {{-- <h4 class="text-center mb-5">Pas de nouvelles inscriptions sur le plateforme</h4>  --}}
                    </div>
                </div>
        </div>
    </div>
  
</div>
@endsection