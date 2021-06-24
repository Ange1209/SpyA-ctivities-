@extends('layouts.app')


@section('content')
<div class="container"  id="showBonus" >
    <div class="row m-3 justify-content-center">
        <div  class="col-md-12 col-lg-12">
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
    </div>
    @if ($bonus->statut == 'en_cours')
        @if (Auth::user()->role == 'employe')
            <div class="row mt-2 justify-content-center">
                <div class="col-md-12 col-lg-6">
                    <div class="card readBonus-c">
                      <div class="cont">
                        <div class="head">
                            <div class="user-p">
                                @if (Auth::user()->role == 'employe')
                                    <div class="profil">
                                        @if ($bonus->user->avatar == NULL) 
                                            <img src="{{asset ('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                        @else
                                            <img src="{{asset('storage/'.$bonus->user->avatar)}}" alt="" class="my-img">
                                        @endif                        
                                    </div>
                                @else   
                                    <a href="{{ route('show', $bonus->user->uuid) }}" >
                                        <div class="profil">
                                            @if ($bonus->user->avatar == NULL) 
                                                <img src="{{asset('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                            @else
                                                <img src="{{asset('storage/'.$bonus->user->avatar)}}" alt="" class="my-img">
                                            @endif                        
                                        </div>
                                    </a> 
                                @endif
            
                                <div class="info">
                                    <h5> <b>{{$bonus->user->name}} </b></h4>
                                    <h6> <b>{{$bonus->user->email}} </h4></p>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="header">
                                <div class="title">
                                    <h4 class="text-capitalize"> {{$bonus->type}}</h4><br>
                                    <h5><b>Motif:</b></h5>
                                </div>
                                <div class="date">
                                    <p>Date debut : {{Carbon\Carbon::parse($bonus->debut)->format('d-m-Y-H:i')}} </p>
                                    <p>Date fin :  {{Carbon\Carbon::parse($bonus->fin)->format('d-m-Y-H:i')}} </p>
                                </div>
                            </div>
        
                            <div class="ctnt">
                                {{-- <p>
                                    {{$bonus->motif}} 
                                </p> --}}
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, blanditiis voluptatem quaerat dolores rem expedita accusantium veritatis incidunt nihil commodi at magnam labore reiciendis tenetur ducimus architecto. Tempora, voluptas vel. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt cumque tempora commodi mollitia corporis, aperiam eaque provident autem? Fugiat, quisquam? Quos nostrum consectetur dolorum sapiente odit blanditiis cum, iure aliquid.</p>
                            </div>
                        </div>
                        <div class="foot">
                            @if (Auth::user()->role  == 'manager')
                                @if ($bonus->role == 'employe')
                                    @if ($bonus->statut == 'attente')
                                        <div class="button">
                                            <div class=" btn act-btn"  data-toggle="modal" data-target="#{{Auth::user()->uuid}}" >
                                                <a ><i class="fas fa-check"></i> Valider</a>
                                            </div>                                   
                                            <div class=" btn dact-btn">
                                                <a href="{{ route('bonusRefus', $bonus) }}" ><i class="fas fa-exclamation-triangle"></i> Refuser</a>
                                            </div>
                                        </div>                         
                                    @else
                                        @if ($bonus->statut == 'valid')
                                            <div class="statut-img">
                                                <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                            </div>   
                                        @else
                                            @if ($bonus->statut == 'en_cours')
                                                <div class="button">
                                                    {{-- <div class=" btn act-btn"  data-toggle="modal" data-target="#{{Auth::user()->uuid}}" >
                                                        <a ><i class="fas fa-check"></i> En cours</a>
                                                    </div>                                    --}}
                                                    <div class=" btn act-btn"  data-toggle="modal" data-target="#{{Auth::user()->uuid}}" >
                                                        <a ><i class="fas fa-check"></i> En cours</a>
                                                    </div>                                   
                                                </div>          
                                            @else
                                                <div class="statut-img">
                                                    <img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
                                                </div>   
                                            @endif
                                        @endif
                                    @endif
                                @else
                                    @if ($bonus->statut == 'valid')
                                        <div class="statut-img">
                                            <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                        </div>   
                                    @else
                                        @if ($bonus->statut == 'attente')
                                            <div class="statut-img">
                                                <img src="{{asset('images/watch.png')}}" alt="" class="my-img ">
                                            </div>  
                                        @else
                                            <div class="statut-img">
                                                <img src="{{asset('images/reject.png')}}" alt="" class="my-img ">
                                            </div>  
                                        @endif
                                    @endif
                                @endif
                            @else
                                @if (Auth::user()->role  == 'admin')
                                    @if ($bonus->statut == 'en_cours')
                                        <div class="button">
                                            <div class=" btn act-btn">
                                                <a href="{{ route('bonusValid', $bonus) }}" ><i class="fas fa-check"></i> Valider</a>
                                            </div>                                   
                                            <div class=" btn dact-btn">
                                                <a href="{{ route('bonusRefus', $bonus) }}" ><i class="fas fa-exclamation-triangle"></i> Refuser</a>
                                            </div>
                                        </div>                   
                                    @else
                                        @if ($bonus->statut == 'valid')
                                            <div class="statut-img">
                                                <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                            </div>  
                                        @else
                                            <div class="statut-img">
                                                <img src="{{asset('images/reject.png')}}" alt="" class="my-img ">
                                            </div> 
                                        @endif
                                    @endif       
                                @else
                                    @if (Auth::user()->role  == 'employe')
                                        @if ($bonus->statut == 'valid')
                                            <div class="statut-img">
                                                <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                            </div> 
                                        @else
                                            @if ($bonus->statut == 'attente')
                                                <div class="statut-img">
                                                    <img src="{{asset('images/watch.png')}}" alt="" class="my-img ">
                                                </div>  
                                            @else    
                                                <div class="statut-img">
                                                    <img src="{{asset('images/reject.png')}}" alt="" class="my-img ">
                                                </div> 
                                            @endif
                                        @endif
                                    @endif    
                                @endif    
        
                            @endif   
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="card wait-b">
                        <div class="title-banner">
                            <div class="title">
                                <h5 >En attente de validation</h3>
                            </div>
                        </div>
                        @if ($validation->count() == 0)
                            <div class="cours-null">
                                <h6 class="text-center">
                                    Aucune déclaration en attente
                                </h6>
                            </div>
                        @else     
                            @foreach ($validation as $item)
                                <div class="wait-p">
                                    <div class="img-p">
                                        <img src="{{asset('images/livraison.png')}}" alt="" class="my-img ">
                                    </div>
                                    <div class="txt">
                                        <p class="text-capitalize">Type : {{$item->type}} </p>
                                        <p>{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y-H:i')}} </p>
                                    </div>
                                    <div class="voir">
                                        <a href="{{ route('showBonus', $item) }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                                    </div> 
                                </div>
                            @endforeach
                        @endif
                        
                    </div>
                    <div class="initAsk-b">
                        <div class="card">
                            <div class=" init">
                                <div class="img-circle">
                                    <img src="{{asset('images/present.png')}}" alt="" class="my-img ">
                                </div>
                                <div class="buton">
                                    <div class="btn init-btn">
                                        <a href="{{ route('initieBonus') }}">
                                            Faire une déclaration
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        @else
            <div class="row mt-2">
                <div class="col-md-12 col-lg-6">
                    <div class="edit-b mb-3">
                        <a href="{{ route('show', $user->uuid) }}" >
                            <div class="circle">
                                <div class="img-p">
                                    @if ($user->avatar == NULL) 
                                        <img src="{{asset ('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                    @else
                                        <img src="{{asset('storage/'.$user->avatar)}}" alt="" class="my-img">
                                    @endif   
                                </div>
                                <div class="info">
                                    <b><p> {{$user->role}} </p></b>
                                </div>                         
                            </div>
                        </a>    
                        <div class="notif-c">
                            <p>Lu et approuvé a plusieurs reprise Lu et approuvé a plusieurs reprise Lu et approuvé a plusieurs reprise Lu et approuvé a plusieurs reprise </p>
                            {{-- <p>
                                {{$notif->description}}
                            </p> --}}
                        </div>
                    </div>

                    <div class="card readBonus-c">
                      <div class="cont">
                        <div class="head">
                            <div class="user-p">
                                @if (Auth::user()->role == 'employe')
                                    <div class="profil">
                                        @if ($bonus->user->avatar == NULL) 
                                            <img src="{{asset ('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                        @else
                                            <img src="{{asset('storage/'.$bonus->user->avatar)}}" alt="" class="my-img">
                                        @endif                        
                                    </div>
                                @else   
                                    <a href="{{ route('show', $bonus->user->uuid) }}" >
                                        <div class="profil">
                                            @if ($bonus->user->avatar == NULL) 
                                                <img src="{{asset('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                            @else
                                                <img src="{{asset('storage/'.$bonus->user->avatar)}}" alt="" class="my-img">
                                            @endif                        
                                        </div>
                                    </a> 
                                @endif
            
                                <div class="info">
                                    <h5> <b>{{$bonus->user->name}} </b></h4>
                                    <h6> <b>{{$bonus->user->email}} </h4></p>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="header">
                                <div class="title">
                                    <h4 class="text-capitalize"> {{$bonus->type}}</h4><br>
                                    <h5><b>Motif:</b></h5>
                                </div>
                                <div class="date">
                                    <p>Date debut : {{Carbon\Carbon::parse($bonus->debut)->format('d-m-Y-H:i')}} </p>
                                    <p>Date fin :  {{Carbon\Carbon::parse($bonus->fin)->format('d-m-Y-H:i')}} </p>
                                </div>
                            </div>
        
                            <div class="ctnt">
                                {{-- <p>
                                    {{$bonus->motif}} 
                                </p> --}}
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, blanditiis voluptatem quaerat dolores rem expedita accusantium veritatis incidunt nihil commodi at magnam labore reiciendis tenetur ducimus architecto. Tempora, voluptas vel. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt cumque tempora commodi mollitia corporis, aperiam eaque provident autem? Fugiat, quisquam? Quos nostrum consectetur dolorum sapiente odit blanditiis cum, iure aliquid.</p>
                            </div>
                        </div>
                        <div class="foot">
                            @if (Auth::user()->role  == 'manager')
                                @if ($bonus->role == 'employe')
                                    @if ($bonus->statut == 'attente')
                                        <div class="button">
                                            <div class=" btn act-btn"  data-toggle="modal" data-target="#{{Auth::user()->uuid}}" >
                                                <a ><i class="fas fa-check"></i> Valider</a>
                                            </div>                                   
                                            <div class=" btn dact-btn">
                                                <a href="{{ route('bonusRefus', $bonus) }}" ><i class="fas fa-exclamation-triangle"></i> Refuser</a>
                                            </div>
                                        </div>                         
                                    @else
                                        @if ($bonus->statut == 'valid')
                                            <div class="statut-img">
                                                <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                            </div>   
                                        @else
                                            @if ($bonus->statut == 'en_cours')
                                                <div class="button">
                                                    {{-- <div class=" btn act-btn"  data-toggle="modal" data-target="#{{Auth::user()->uuid}}" >
                                                        <a ><i class="fas fa-check"></i> En cours</a>
                                                    </div>                                    --}}
                                                    <div class=" btn act-btn"  data-toggle="modal" data-target="#{{Auth::user()->uuid}}" >
                                                        <a ><i class="fas fa-check"></i> En cours</a>
                                                    </div>                                   
                                                </div>          
                                            @else
                                                <div class="statut-img">
                                                    <img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
                                                </div>   
                                            @endif
                                        @endif
                                    @endif
                                @else
                                    @if ($bonus->statut == 'valid')
                                        <div class="statut-img">
                                            <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                        </div>   
                                    @else
                                        @if ($bonus->statut == 'attente')
                                            <div class="statut-img">
                                                <img src="{{asset('images/watch.png')}}" alt="" class="my-img ">
                                            </div>  
                                        @else
                                            <div class="statut-img">
                                                <img src="{{asset('images/reject.png')}}" alt="" class="my-img ">
                                            </div>  
                                        @endif
                                    @endif
                                @endif
                            @else
                                @if (Auth::user()->role  == 'admin')
                                    @if ($bonus->statut == 'en_cours')
                                        <div class="button">
                                            <div class=" btn act-btn">
                                                <a href="{{ route('bonusValid', $bonus) }}" ><i class="fas fa-check"></i> Valider</a>
                                            </div>                                   
                                            <div class=" btn dact-btn">
                                                <a href="{{ route('bonusRefus', $bonus) }}" ><i class="fas fa-exclamation-triangle"></i> Refuser</a>
                                            </div>
                                        </div>                   
                                    @else
                                        @if ($bonus->statut == 'valid')
                                            <div class="statut-img">
                                                <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                            </div>  
                                        @else
                                            <div class="statut-img">
                                                <img src="{{asset('images/reject.png')}}" alt="" class="my-img ">
                                            </div> 
                                        @endif
                                    @endif       
                                @else
                                    @if (Auth::user()->role  == 'employe')
                                        @if ($bonus->statut == 'valid')
                                            <div class="statut-img">
                                                <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                            </div> 
                                        @else
                                            @if ($bonus->statut == 'attente')
                                                <div class="statut-img">
                                                    <img src="{{asset('images/watch.png')}}" alt="" class="my-img ">
                                                </div>  
                                            @else    
                                                <div class="statut-img">
                                                    <img src="{{asset('images/reject.png')}}" alt="" class="my-img ">
                                                </div> 
                                            @endif
                                        @endif
                                    @endif    
                                @endif    
        
                            @endif   
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="card showAsk-c">
                        {{-- <div class="ul-p">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-enCours-tab" data-toggle="pill" href="#pills-attente" role="tab" aria-controls="pills-attente" aria-selected="false">Nouvelles déclarations</a>
                                </li>   
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active " id="pills-attente" role="tabpanel" aria-labelledby="pills-attente-tab"> 
                                <div  id="showAsk" class="row mt-3">
                                    <div class="col-md-12 col-lg-12">  
                                        <div class="card wait-b">
                                            <div class="title-banner">
                                                <div class="title">
                                                    <h4>En attente de validation</h3>
                                                </div>
                                            </div>
                                            @if ($validation->count() == 0)
                                                <div class="cours-null">
                                                    <h5 class="text-center mt-3 mb-3">
                                                        Aucune demande en attente
                                                    </h5>
                                                </div>
                                            @else     
                                                <div class="table-b">
                                                    <table id="trdTable" class="display mt-3" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th> <b>Employés</b></th>
                                                                <th><b>Type</b></th>
                                                                <th><b>Date debut et fin</b></th>
                                                                <th><b>Voir</b></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($validation as $item)
                                                            <tr>
                                                                <td>{{$item->name}}</td>
                                                                <td>{{$item->type}}</td>
                                                                <td> 
                                                                    <p>{{$item->debut}}</p>
                                                                    <p>{{$item->fin}}</p> 
                                                                </td>
                                                                <td>
                                                                    <div class="voir">
                                                                        <a href="{{ route('showBonus', $item) }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                                                                    </div> 
                                                                </td>
                                                            </tr>
                                                            @endforeach 
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th> <b>Employés</b></th>
                                                                <th><b>Type</b></th>
                                                                <th><b>Date debut et fin</b></th>
                                                                <th><b>Voir</b></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>  
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>                                                                                                                                                                                
        @endif
    @else    





    @endif

    <div class="row mt-2">
        <div class="col-md-12 col-lg-6">
            <div class="card readBonus-c">
              <div class="cont">
                <div class="head">
                    <div class="user-p">
                        @if (Auth::user()->role == 'employe')
                            <div class="profil">
                                @if ($bonus->user->avatar == NULL) 
                                    <img src="{{asset ('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                @else
                                    <img src="{{asset('storage/'.$bonus->user->avatar)}}" alt="" class="my-img">
                                @endif                        
                            </div>
                        @else   
                            <a href="{{ route('show', $bonus->user->uuid) }}" >
                                <div class="profil">
                                    @if ($bonus->user->avatar == NULL) 
                                        <img src="{{asset('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                    @else
                                        <img src="{{asset('storage/'.$bonus->user->avatar)}}" alt="" class="my-img">
                                    @endif                        
                                </div>
                            </a> 
                        @endif
    
                        <div class="info">
                            <h5> <b>{{$bonus->user->name}} </b></h4>
                            <h6> <b>{{$bonus->user->email}} </h4></p>
                        </div>
                    </div>
                </div>
                <div class="body">
                    <div class="header">
                        <div class="title">
                            <h4 class="text-capitalize"> {{$bonus->type}}</h4><br>
                            <h5><b>Motif:</b></h5>
                        </div>
                        <div class="date">
                            <p>Date debut : {{Carbon\Carbon::parse($bonus->debut)->format('d-m-Y-H:i')}} </p>
                            <p>Date fin :  {{Carbon\Carbon::parse($bonus->fin)->format('d-m-Y-H:i')}} </p>
                        </div>
                    </div>

                    <div class="ctnt">
                        {{-- <p>
                            {{$bonus->motif}} 
                        </p> --}}
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit, blanditiis voluptatem quaerat dolores rem expedita accusantium veritatis incidunt nihil commodi at magnam labore reiciendis tenetur ducimus architecto. Tempora, voluptas vel. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt cumque tempora commodi mollitia corporis, aperiam eaque provident autem? Fugiat, quisquam? Quos nostrum consectetur dolorum sapiente odit blanditiis cum, iure aliquid.</p>
                    </div>
                </div>
                <div class="foot">
                    @if (Auth::user()->role  == 'manager')
                        @if ($bonus->role == 'employe')
                            @if ($bonus->statut == 'attente')
                                <div class="button">
                                    <div class=" btn act-btn"  data-toggle="modal" data-target="#{{Auth::user()->uuid}}" >
                                        <a ><i class="fas fa-check"></i> Valider</a>
                                    </div>                                   
                                    <div class=" btn dact-btn">
                                        <a href="{{ route('bonusRefus', $bonus) }}" ><i class="fas fa-exclamation-triangle"></i> Refuser</a>
                                    </div>
                                </div>                         
                            @else
                                @if ($bonus->statut == 'valid')
                                    <div class="statut-img">
                                        <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                    </div>   
                                @else
                                    @if ($bonus->statut == 'en_cours')
                                        <div class="button">
                                            {{-- <div class=" btn act-btn"  data-toggle="modal" data-target="#{{Auth::user()->uuid}}" >
                                                <a ><i class="fas fa-check"></i> En cours</a>
                                            </div>                                    --}}
                                            <div class=" btn act-btn"  data-toggle="modal" data-target="#{{Auth::user()->uuid}}" >
                                                <a ><i class="fas fa-check"></i> En cours</a>
                                            </div>                                   
                                        </div>          
                                    @else
                                        <div class="statut-img">
                                            <img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
                                        </div>   
                                    @endif
                                @endif
                            @endif
                        @else
                            @if ($bonus->statut == 'valid')
                                <div class="statut-img">
                                    <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                </div>   
                            @else
                                @if ($bonus->statut == 'attente')
                                    <div class="statut-img">
                                        <img src="{{asset('images/watch.png')}}" alt="" class="my-img ">
                                    </div>  
                                @else
                                    <div class="statut-img">
                                        <img src="{{asset('images/reject.png')}}" alt="" class="my-img ">
                                    </div>  
                                @endif
                            @endif
                        @endif
                    @else
                        @if (Auth::user()->role  == 'admin')
                            @if ($bonus->statut == 'en_cours')
                                <div class="button">
                                    <div class=" btn act-btn">
                                        <a href="{{ route('bonusValid', $bonus) }}" ><i class="fas fa-check"></i> Valider</a>
                                    </div>                                   
                                    <div class=" btn dact-btn">
                                        <a href="{{ route('bonusRefus', $bonus) }}" ><i class="fas fa-exclamation-triangle"></i> Refuser</a>
                                    </div>
                                </div>                   
                            @else
                                @if ($bonus->statut == 'valid')
                                    <div class="statut-img">
                                        <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                    </div>  
                                @else
                                    <div class="statut-img">
                                        <img src="{{asset('images/reject.png')}}" alt="" class="my-img ">
                                    </div> 
                                @endif
                            @endif       
                        @else
                            @if (Auth::user()->role  == 'employe')
                                @if ($bonus->statut == 'valid')
                                    <div class="statut-img">
                                        <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                    </div> 
                                @else
                                    @if ($bonus->statut == 'attente')
                                        <div class="statut-img">
                                            <img src="{{asset('images/watch.png')}}" alt="" class="my-img ">
                                        </div>  
                                    @else    
                                        <div class="statut-img">
                                            <img src="{{asset('images/reject.png')}}" alt="" class="my-img ">
                                        </div> 
                                    @endif
                                @endif
                            @endif    
                        @endif    

                    @endif   
                </div>
              </div>
            </div>
        </div>
        
        @if (Auth::user()->role  == 'manager')
            @if ($bonus->user->role == 'manager')
                @if ($bonus->statut == 'attente')
                    <div class="col-md-2 col-lg-2">
                        <div class="card edit-b">
                            <div class="edit-c">
                                <a href="{{ route('editBonus', $bonus) }}" > <div class="circle" type="button"  data-toggle="tooltip" data-placement="right" title="Modifier">
                                    <img src="{{asset('images/iniAsk.png')}}" alt="" class="my-img ">
                                </div></a>
                                <div class="circle"  type="button" data-toggle="tooltip" data-placement="right" title="Supprimer">
                                    <a href="{{ route('supprimerBonus', $bonus) }}" ><img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                @else
                    @if ($bonus->statut == 'refus')
                        <div class="col-md-2 col-lg-2">
                            <div class="card edit-b">
                                <div class="edit-c">
                                    <a href="{{ route('editBonus', $bonus) }}" > <div class="circle" type="button"  data-toggle="tooltip" data-placement="right" title="Modifier">
                                        <img src="{{asset('images/iniAsk.png')}}" alt="" class="my-img ">
                                    </div></a>
                                    <div class="circle"  type="button" data-toggle="tooltip" data-placement="right" title="Supprimer">
                                        <a href="{{ route('supprimerBonus', $bonus) }}" ><img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        
                    @endif
                    
                @endif  
            @endif
        @else                 
            @if (Auth::user()->role  == 'employe')
                @if ($bonus->statut == 'attente')
                    <div class="col-md-2 col-lg-2">
                        <div class="card edit-b">
                            <div class="edit-c">
                                <a href="{{ route('editBonus', $bonus) }}" > <div class="circle" type="button"  data-toggle="tooltip" data-placement="right" title="Modifier">
                                    <img src="{{asset('images/iniAsk.png')}}" alt="" class="my-img ">
                                </div></a>
                                <div class="circle"  type="button" data-toggle="tooltip" data-placement="right" title="Supprimer">
                                    <a href="{{ route('supprimerBonus', $bonus) }}" ><img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    @if ($bonus->statut == 'refus')
                        <div class="col-md-2 col-lg-2">
                            <div class="card edit-b">
                                <div class="edit-c">
                                    <a href="{{ route('editBonus', $bonus) }}" > <div class="circle" type="button"  data-toggle="tooltip" data-placement="right" title="Modifier">
                                        <img src="{{asset('images/iniAsk.png')}}" alt="" class="my-img ">
                                    </div></a>
                                    <div class="circle"  type="button" data-toggle="tooltip" data-placement="right" title="Supprimer">
                                        <a href="{{ route('supprimerBonus', $bonus) }}" ><img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        
                    @endif
                    
                @endif 
            @endif
        @endif
    </div>

    <div class="col-md-12 col-lg-8">
        <div class="card showAsk-c">
            <div class="ul-p">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-enCours-tab" data-toggle="pill" href="#pills-attente" role="tab" aria-controls="pills-attente" aria-selected="false">Nouvelles déclarations</a>
                    </li>   
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active " id="pills-attente" role="tabpanel" aria-labelledby="pills-attente-tab"> 
                    <div  id="showAsk" class="row mt-3">
                        <div class="col-md-12 col-lg-12">  
                            <div class="card wait-b">
                                <div class="title-banner">
                                    <div class="title">
                                        <h4>En attente de validation</h3>
                                    </div>
                                </div>
                                @if ($validation->count() == 0)
                                    <div class="cours-null">
                                        <h5 class="text-center mt-3 mb-3">
                                            Aucune demande en attente
                                        </h5>
                                    </div>
                                @else     
                                    <div class="table-b">
                                        <table id="trdTable" class="display mt-3" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th> <b>Employés</b></th>
                                                    <th><b>Type</b></th>
                                                    <th><b>Date debut et fin</b></th>
                                                    <th><b>Voir</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($validation as $item)
                                                <tr>
                                                    <td>{{$item->name}}</td>
                                                    <td>{{$item->type}}</td>
                                                    <td> 
                                                        <p>{{$item->debut}}</p>
                                                        <p>{{$item->fin}}</p> 
                                                    </td>
                                                    <td>
                                                        <div class="voir">
                                                            <a href="{{ route('showBonus', $item) }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                                                        </div> 
                                                    </td>
                                                </tr>
                                                @endforeach 
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th> <b>Employés</b></th>
                                                    <th><b>Type</b></th>
                                                    <th><b>Date debut et fin</b></th>
                                                    <th><b>Voir</b></th>
                                                </tr>
                                            </tfoot>
                                        </table>  
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>


    {{-- <div class="row mt-2  justify-content-center">
        <div class="col-md-12 col-lg-8">
            <div class="body">
                <div class="user">
                    <a href="">
                       <div class="user-info">
                           <div class="bio-reveal">
                              <h2>@jennlukas</h2>
                               <p>Front-end consultant and dev, Girl Develop It teacher, .net Mag writer, http://thenerdary.net  , http://ladiesintech.com  , https://fuckyeahhovers.tumblr.com</p>;
                           </div>
                       </div>
                   </a>
                </div>
            </div>
        </div>
    </div>   --}}

    <div class="modal bonus-m fade" id="{{Auth::user()->uuid}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="header" style="margin: auto; margin-top:15px; font-size:18px; color: #E64C3C">
                    <b><h5 class="modal-title" id="exampleModalLabel">Note de validation </h5></b>
                </div>
                <div class="modal-body conf-pwd">
                    <form action="{{route('storeNotif', $bonus) }}" method="post">
                        @csrf  
                        <div class="form-group w-100 mb-5">
                                            
                            <div class="input-div">
                               <textarea name="description" id="description" rows="2"  class="form-control @error('description') is-invalid @enderror">
                               </textarea>
                               @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                               @enderror
                    
                                <label for="description" class="form-label">{{ __('Justification') }}</label>
                           
                            </div>
                        </div>

                        <div class="form-group w-100 mb-3">
                                        
                         
                        </div>
    
                        <div class=" row mt-5 mb-2 ">
                            <button type="submit" class="btn edit-btn">
                                <i class="fas fa-edit"></i>
                                {{ __('Envoyer') }}
                               
                            </button>
                        </div>
                                      
                    </form>    
                </div>
                {{-- <div class="footer">
                    <button type="button" class="btn close-btn" data-dismiss="modal">Fermer</button>
                </div> --}}
            </div>
        </div>
    </div>
</div>

@endsection
  