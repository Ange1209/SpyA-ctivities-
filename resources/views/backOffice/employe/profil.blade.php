
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
        <div class="row justify-content-center mt-5">
                <div class="col-12 col-md-4 mb-3">
                    <div class="card emp-b">
                        <div class="img-p">
                            <div class="icon-b">
                                @if ($department->id == 1)
                                    <img src="{{asset('images/accountant.png')}}" alt="" class="my-img">  
                                @else
                                    @if ($department->id == 2)
                                        <img src="{{asset('images/social.png')}}" alt="" class="my-img">  
                                    @else
                                        @if ($department->id == 3)
                                            <img src="{{asset('images/development.png')}}" alt="" class="my-img">                                      
                                        @else
                                            @if ($department->id == 4)
                                                <img src="{{asset('images/analysis.png')}}" alt="" class="my-img">                                          
                                            @else
                                                <img src="{{asset('images/megaphone.png')}}" alt="" class="my-img">     
                                            @endif
                                        @endif
                                    @endif
                                    
                                @endif
                            </div>
                        </div>

                        <div class="info-b">
                            <div class="title" >
                                <h5>Departement : <b>{{$department->name}} </b> </h5>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>Nombre d'employé</p>
                                </div>
                                <div class="count">
                                    {{$users->count()}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>Demandes en cours</p>
                                </div>
                                <div class="count">
                                    {{$totalCours->count()}}
                                    {{-- {{$bloquer->count()}} --}}
                                </div>
                            </div>
                            <div class="box">
                            </div>
                            <div class="title" >
                                <a href="{{ route('departement',$department) }}">Plus de detatils</a>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="col-12 col-md-4 mb-3">
                    <div class="card emp-b">
                        <div class="img-p">
                            <div class="icon-b">
                                <img src="{{asset('images/ask.png')}}" alt="" class="my-img">
                            </div>
                        </div>
                        <div class="info-b">
                            <div class="title">
                                <h5>Mes demandes</h5>
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
                                <a href="{{ route('showDemande') }}">Plus de detatils</a>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="col-12 col-md-4 mb-3">
                    <div class="card emp-b">
                        <div class="img-p">
                            <div class="icon-b">
                                <img src="{{asset('images/hand.png')}}" alt="" class="my-img">   
                            </div>
                        </div>
                        <div class="info-b">
                            <div class="title"  >
                                <h5>Mes Bonus</h5>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>En attente de validation</p>
                                </div>
                                <div class="count">
                                    3
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
                            <div class="box">
                               
                            </div>
                            <div class="title" >
                                <a href="">Plus de detatils</a>
                            </div>
                        </div>
                    </div>
               </div>
        </div>
        
    </div>
  
</div>
@endsection