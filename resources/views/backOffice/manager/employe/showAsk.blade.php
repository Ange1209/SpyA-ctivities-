@extends('layouts.app')


@section('content')
<div class="container pt-1">
<div class="row m-4 justify-content-center">
    <div  class="col-md-12 col-lg-11 pr-5">
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
    <div id="showRead" class="row mt-2  justify-content-center">
        <div class="col-md-12 col-lg-8">
            <div class="card showRead-c">
               <div class="head">
                <div class="profil">
                    <div class="img-p">
                        @if (Auth::user()->role == 'employe')
                            <div class="img-circle">
                                @if ($demande->avatar == NULL) 
                                    <img src="{{asset('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                @else
                                    <img src="{{asset('storage/'.$demande->avatar)}}" alt="" class="my-img">
                                @endif                        
                            </div>
                        @else   
                            <a href="{{ route('show', $demande->uuid) }}" >
                                <div class="img-circle">
                                    @if ($demande->avatar == NULL) 
                                        <img src="{{asset('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                    @else
                                        <img src="{{asset('storage/'.$demande->avatar)}}" alt="" class="my-img">
                                    @endif                        
                                </div>
                            </a> 
                        @endif
                    </div>
                    <div class="info-p">
                        <p>Nom : <b> {{$demande->name}} </b></p>
                        <p>Email :<b> {{$demande->email}}  </b> </p>
                    </div>
                </div>
               
                <div class="date">
                    <p>Envoyer le : {{Carbon\Carbon::parse($demande->created_at)->format('d-m-Y-H:i')}} </p>
                    <p>Date debut : {{Carbon\Carbon::parse($demande->debut)->format('d-m-Y-H:i')}} </p>
                    <p>Date fin :  {{Carbon\Carbon::parse($demande->fin)->format('d-m-Y-H:i')}} </p>
                </div>
               </div>
               <div class="title">
                <h2 class="text-capitalize"> {{$demande->type}} </h2>
                </div>
               <div class="body">

                    <h4> <b>Motif:</b> </h5>
                    <p>
                        {{$demande->motif}} 
                    </p>
               </div>
               <div class="foot">
                   @if (Auth::user()->role  == 'manager')
                       @if ($demande->role == 'employe')
                            @if ($demande->statut == 'attente')
                                <div class="button">
                                    <div class=" btn act-btn">
                                        <a href="{{ route('valid', $demande) }}" ><i class="fas fa-check"></i> Valider</a>
                                    </div>                                   
                                    <div class=" btn dact-btn">
                                        <a href="{{ route('refus', $demande) }}" ><i class="fas fa-exclamation-triangle"></i> Refuser</a>
                                    </div>
                                </div>                         
                            @else
                                @if ($demande->statut == 'valid')
                                    <div class="statut-img">
                                        <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                    </div>   
                                @else
                                    <div class="statut-img">
                                        <img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
                                    </div>   
                                @endif
                            @endif
                       @else
                           @if ($demande->statut == 'valid')
                               <div class="statut-img">
                                   <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                               </div>   
                           @else
                               @if ($demande->statut == 'attente')
                                    <div class="statut-img">
                                        <img src="{{asset('images/watch.png')}}" alt="" class="my-img ">
                                    </div>  
                                    {{-- <div class="button">
                                        <div class=" btn act-btn">
                                            <a href="{{ route('editDemande', $demande) }}" ><i class="fas fa-check"></i> Modifier</a>
                                        </div> 
                                    </div>   --}}
                               @else
                                    <div class="statut-img">
                                        <img src="{{asset('images/reject.png')}}" alt="" class="my-img ">
                                    </div>  
                                    {{-- <div class=" button ">
                                        <div class=" btn act-btn">
                                            <a href="{{ route('editDemande', $demande) }}" ><i class="fas fa-check"></i> Modifier</a>
                                        </div> 
                                    </div>   --}}
                               @endif
                           @endif
                       @endif
                   @else
                       @if (Auth::user()->role  == 'admin')
                           @if ($demande->statut == 'attente')
                               <div class="button">
                                   <div class=" btn act-btn">
                                       <a href="{{ route('valid', $demande) }}" ><i class="fas fa-check"></i> Valider</a>
                                   </div>                                   
                                   <div class=" btn dact-btn">
                                       <a href="{{ route('refus', $demande) }}" ><i class="fas fa-exclamation-triangle"></i> Refuser</a>
                                   </div>
                               </div>                   
                           @else
                               @if ($demande->statut == 'valid')
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
                               @if ($demande->statut == 'valid')
                                    <div class="statut-img">
                                        <img src="{{asset('images/validation.png')}}" alt="" class="my-img ">
                                    </div> 
                               @else
                                   @if ($demande->statut == 'attente')
                                        <div class="statut-img">
                                            <img src="{{asset('images/watch.png')}}" alt="" class="my-img ">
                                        </div>  
                                        {{-- <div class="button">
                                            <div class=" btn act-btn">
                                                <a href="{{ route('editDemande', $demande) }}" ><i class="fas fa-check"></i> Modifier</a>
                                            </div> 
                                        </div>    --}}
                                   @else    
                                        <div class="statut-img">
                                            <img src="{{asset('images/reject.png')}}" alt="" class="my-img ">
                                        </div> 
                                       {{-- <div class=" button ">
                                            <div class=" btn act-btn">
                                                <a href="{{ route('editDemande', $demande) }}" ><i class="fas fa-check"></i> Modifier</a>
                                            </div> 
                                        </div>  --}}
                                   @endif
                               @endif
                           @endif    
                       @endif    

                   @endif    
               </div>
            </div>
        </div> 
        @if (Auth::user()->role  == 'manager')
            @if ($demande->role == 'manager')
                @if ($demande->statut == 'attente')
                    <div class="col-md-2 col-lg-2">
                        <div class="card edit-b">
                            <div class="edit-c">
                                <a href="{{ route('editDemande', $demande) }}" > <div class="circle" type="button"  data-toggle="tooltip" data-placement="right" title="Modifier">
                                    <img src="{{asset('images/iniAsk.png')}}" alt="" class="my-img ">
                                </div></a>
                                <div class="circle"  type="button" data-toggle="tooltip" data-placement="right" title="Supprimer">
                                    <a href="{{ route('supprimer', $demande) }}" ><img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                @else
                    @if ($demande->statut == 'refus')
                        <div class="col-md-2 col-lg-2">
                            <div class="card edit-b">
                                <div class="edit-c">
                                    <a href="{{ route('editDemande', $demande) }}" > <div class="circle" type="button"  data-toggle="tooltip" data-placement="right" title="Modifier">
                                        <img src="{{asset('images/iniAsk.png')}}" alt="" class="my-img ">
                                    </div></a>
                                    <div class="circle"  type="button" data-toggle="tooltip" data-placement="right" title="Supprimer">
                                        <a href="{{ route('supprimer', $demande) }}" ><img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
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
                @if ($demande->statut == 'attente')
                    <div class="col-md-2 col-lg-2">
                        <div class="card edit-b">
                            <div class="edit-c">
                                <a href="{{ route('editDemande', $demande) }}" > <div class="circle" type="button"  data-toggle="tooltip" data-placement="right" title="Modifier">
                                    <img src="{{asset('images/iniAsk.png')}}" alt="" class="my-img ">
                                </div></a>
                                <div class="circle"  type="button" data-toggle="tooltip" data-placement="right" title="Supprimer">
                                    <a href="{{ route('supprimer', $demande) }}" ><img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
                                </div>
                            </div>
                        </div>
                    </div>
                
                @else
                    @if ($demande->statut == 'refus')
                        <div class="col-md-2 col-lg-2">
                            <div class="card edit-b">
                                <div class="edit-c">
                                    <a href="{{ route('editDemande', $demande) }}" > <div class="circle" type="button"  data-toggle="tooltip" data-placement="right" title="Modifier">
                                        <img src="{{asset('images/iniAsk.png')}}" alt="" class="my-img ">
                                    </div></a>
                                    <div class="circle"  type="button" data-toggle="tooltip" data-placement="right" title="Supprimer">
                                        <a href="{{ route('supprimer', $demande) }}" ><img src="{{asset('images/rejected.png')}}" alt="" class="my-img ">
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
   
</div>
@endsection
  