@extends('layouts.app')

<?php $currentPage = 'samira';?>


@section('content')

<div class="container pt-2">

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div id="manager-b">
                <div class="card manager-c">
                    <div class="img-p">
                        <a href="{{ route('show', $manager) }}" >
                            <div class="circle">
                                @if ($manager->avatar == NULL) 
                                <img src="{{asset('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                @else
                                <img src="{{asset('storage/'.$manager->avatar)}}" alt="" class="my-img ">
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="info-b">
                        <p>Nom : <b> {{$manager->name}}</b></p>
                        <p>Role : <b>{{$manager->role}}</b> </p>
                    </div>
                    <div class="stat-ban">
                        <div class="logo-p">
                            <img src="{{asset('images/trend.png')}}" alt="" class="my-img">  
                        </div>
                        <div class="title">
                           <b> <h4>Statistiques</h4></b>
                        </div>
                    </div>
                    <div class="stat-c">
                        <div class="stat-box">
                            <div class="icon-b">
                                <img src="{{asset('images/team.png')}}" alt="" class="my-img">  
                            </div>
                            <div class="count">
                                {{$users->count()}}
                            </div>
                        </div>    
                        <div class="stat-box">
                            <div class="icon-b">
                                <img src="{{asset('images/ask.png')}}" alt="" class="my-img">  
                            </div>
                            <div class="count">
                                {{$demandes->count()}}
                            </div>
                        </div>    
                        <div class="stat-box">
                            <div class="icon-b">
                                <img src="{{asset('images/hand.png')}}" alt="" class="my-img">  
                            </div>
                            <div class="count">
                                {{$bonus->count()}}
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md col-lg-9">
            <div class="card showAsk-c">
                {{-- <div class="dep-title">
                    <h2>Direction_Technique</h2>
                </div> --}}
                <div class="dep-title">
                    <div class="logo-p">
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
                    <div class="tit">
                        <h2>{{$department->name}}</h2>
                    </div>
                </div>

                @if (Auth::user()->role == 'admin')
                    <div class="ul-p">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-attente-tab" data-toggle="pill" href="#pills-attente" role="tab" aria-controls="pills-attente" aria-selected="true">Employés</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-enCours-tab" data-toggle="pill" href="#pills-enCours" role="tab" aria-controls="pills-enCours" aria-selected="false">Demandes en cours</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-archive-tab" data-toggle="pill" href="#pills-archive" role="tab" aria-controls="pills-archive" aria-selected="false">Demandes en attentes </a>
                            </li>      
                            <li class="nav-item">
                                <a class="nav-link" id="pills-bonus-tab" data-toggle="pill" href="#pills-bonus" role="tab" aria-controls="pills-bonus" aria-selected="false">Bonus </a>
                            </li>      
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-attente" role="tabpanel" aria-labelledby="pills-attente-tab"> 
                                <div  id="showAsk" class="row mt-3">
                                    <div class="col-md-12 col-lg-12">  
                                        <div class="card emp-b">
                                            <div class="title-banner">
                                                <div class="title">
                                                    <h4>Employés</h4>
                                                </div>
                                            </div>
                                            @if ($users->count() == 0)
                                                <div class="cours-null">
                                                    <h5 class="text-center">
                                                        Aucun employé enregistré
                                                    </h5>
                                                </div>
                                            @else
                                                <div class="table-b">
                                                    <table id="trdTable" class="display mt-3" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th> <b>Employés</b></th>
                                                                <th><b>E-mail</b></th>
                                                                <th><b>Statut</b></th>
                                                                <th><b>Voir</b></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($users as $item)
                                                            {{-- {{dd($item)}} --}}
                                                            <tr>
                                                                <td>{{$item->name}}</td>
                                                                <td>{{$item->email}}</td>
                                                                <td> 
                                                                    @if ($item->admin_action == 1)
                                                                        <div class=" stat-p">
                                                                            <img src="{{asset('images/validation.png')}}" alt="" class="my-img">                                          
                                                                        </div>  
                                                                    @else
                                                                        @if ($item->admin_action == 0) 
                                                                            <div class=" stat-p">
                                                                                <img src="{{asset('images/watch.png')}}" alt="" class="my-img">                                          
                                                                            </div>
                                                                        @else
                                                                            <div class=" stat-p">
                                                                                <img src="{{asset('images/reject.png')}}" alt="" class="my-img">                                          
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                
                                                                <td>
                                                                    <div class="voir">
                                                                        <a href="{{ route('show', $item) }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                                                                    </div> 
                                                                </td>
                                                            </tr>
                                                            @endforeach 
                                                            
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th> <b>Employés</b></th>
                                                                <th><b>E-mail</b></th>
                                                                <th><b>Statut</b></th>
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
                            <div class="tab-pane fade" id="pills-enCours" role="tabpanel" aria-labelledby="pills-enCours-tab"> 
                                <div id="showAsk" class="row mt-3">
                                    <div class="col-md-12 col-lg-12">  
                                        <div class="card enCour-b">
                                            <div class="title-banner">
                                                <div class="title">
                                                    <h4>En cours</h4>
                                                </div>
                                            </div>
                                            @if($enCours->count() == 0)
                                                <div class="cours-null">
                                                    <h5 class="text-center">
                                                        Aucune demande en cours
                                                    </h5>
                                                </div>
                                            @else    
                                                <div class="table-b">
                                                    <table id="scdTable" class="display mt-3" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th> <b>Employés</b></th>
                                                                <th><b>Type</b></th>
                                                                <th><b>Date debut et fin</b></th>
                                                                <th><b>Voir</b></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($enCours as $item)
                                                                
                                                            <tr>
                                                                <td>{{$item->name}}</td>
                                                                <td>{{$item->type}}</td>
                                                                <td> 
                                                                    <p>{{$item->debut}}</p>
                                                                    <p>{{$item->fin}}</p> 
                                                                </td>
                                
                                                                <td>
                                                                    <div class="voir">
                                                                        <a href="{{ route('showRead', $item) }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
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
                            <div class="tab-pane fade" id="pills-archive" role="tabpanel" aria-labelledby="pills-archive-tab"> 
                                <div  id="showAsk" class="row mt-3">
                                    <div class="col-md-12 col-lg-12">  
                                        <div class="txt"> 
                                            <div class="card wait-b">
                                                <div class="title-banner" style="height: 50px, padding-top: 5px">
                                                    <div class="title">
                                                        <h4 >En attente</h4>
                                                    </div>
                                                </div>

                                                @if ($attentes->count() == 0)
                                                    <div class="cours-null">
                                                        <h5 class="text-center">
                                                            Aucune demande en attente
                                                        </h5>
                                                    </div>
                                                @else
                                                    <div class="table-b">
                                                        <table id="myTable" class="display mt-3" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>Employe</b></th>
                                                                    <th><b>Type</b></th>
                                                                    <th><b>Dates</b></th>
                                                                    <th><b>Envoyé le</b></th>
                                                                    <th><b>voir</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($attentes as $item)
                                                                    
                                                                <tr>
                                                                    <td>{{$item->name}}</td>
                                                                    <td>{{$item->type}}</td>
                                                                    <td> 
                                                                        <p>{{$item->debut}}</p>
                                                                        <p>{{$item->fin}}</p> <div class="l"></div>
                                                                    </td>
                                                                    <td>
                                                                        <p>{{$item->created_at}}</p>
                                                                    </td>
                                                                    <td>
                                                                        <div class="voir">
                                                                            <a href="{{ route('showRead', $item) }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                                                                        </div> 
                                                                    </td>
                                                                </tr>
                                                                @endforeach 
                                                                
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th><b>Employe</b></th>
                                                                    <th><b>Type</b></th>
                                                                    <th><b>Dates</b></th>
                                                                    <th><b>Statut</b></th>
                                                                    <th><b>voir</b></th>
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
                            <div class="tab-pane fade" id="pills-bonus" role="tabpanel" aria-labelledby="pills-bonus-tab"> 
                                <div  id="showAsk" class="row mt-3">
                                    <div class="col-md-12 col-lg-12">  
                                        <div class="txt"> 
                                            <div class="card bonus-b">
                                                <div class="title-banner" style="height: 50px, padding-top: 5px">
                                                    <div class="title">
                                                        <h3>Bonus</h3>
                                                    </div>
                                                </div>
                                                @if($bonus->count() == 0)
                                                    <div class="cours-null">
                                                        <h5 class="text-center">
                                                            Aucun bonus
                                                        </h5>
                                                    </div>
                                                @else    
                                                    <div class="table-b">
                                                        <table id="myTablee" class="display mt-3" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th><b>Employe</b></th>
                                                                    <th><b>Type</b></th>
                                                                    <th><b>Dates</b></th>
                                                                    <th><b>Statut</b></th>
                                                                    <th><b>voir</b></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($bonus as $item)
                                                                    
                                                                <tr>
                                                                    <td>{{$item->name}}</td>
                                                                    <td>{{$item->type}}</td>
                                                                    <td> 
                                                                        <p>{{$item->debut}}</p>
                                                                        <p>{{$item->fin}}</p> <div class="l"></div>
                                                                    </td>
                                                                    <td>
                                                                        @if ($item->statut == 'valid')
                                                                            <div class=" stat-p">
                                                                                <img src="{{asset('images/validation.png')}}" alt="" class="my-img">                                          
                                                                            </div>  
                                                                        @else
                                                                            @if ($item->statut == 'refus') 
                                                                                <div class=" stat-p">
                                                                                    <img src="{{asset('images/reject.png')}}" alt="" class="my-img">                                          
                                                                                </div>
                                                                          
                                                                            @else
                                                                                <div class=" stat-p">
                                                                                    <img src="{{asset('images/watch.png')}}" alt="" class="my-img">                                          
                                                                                </div>
                                                                            @endif
                                                                        @endif
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
                                                                    <th><b>Employe</b></th>
                                                                    <th><b>Type</b></th>
                                                                    <th><b>Dates</b></th>
                                                                    <th><b>Statut</b></th>
                                                                    <th><b>voir</b></th>
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
                @else
                <div class="ul-p">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-attente-tab" data-toggle="pill" href="#pills-attente" role="tab" aria-controls="pills-attente" aria-selected="true">Employés du departement</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-enCours-tab" data-toggle="pill" href="#pills-enCours" role="tab" aria-controls="pills-enCours" aria-selected="false">Demandes en cours</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-archive-tab" data-toggle="pill" href="#pills-archive" role="tab" aria-controls="pills-archive" aria-selected="false">Bonus </a>
                        </li>      
                    </ul>
                </div>
                  <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-attente" role="tabpanel" aria-labelledby="pills-attente-tab"> 
                            <div  id="showAsk" class="row mt-3">
                                <div class="col-md-12 col-lg-12">  
                                    <div class="card archiv-b">
                                        <div class="title-banner">
                                            <div class="title">
                                                <h4>Employés</h3>
                                            </div>
                                        </div>
                                        <div class="table-b">
                                            <table id="trdTable" class="display mt-3" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th> <b>Employés</b></th>
                                                        <th><b>E-mail</b></th>
                                                        <th><b>Statut</b></th>
                                                        <th><b>Voir</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $item)
                                                    {{-- {{dd($item)}} --}}
                                                    <tr>
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->email}}</td>
                                                        <td> 
                                                            @if ($item->admin_action == 1)
                                                                <div class=" stat-p">
                                                                    <img src="{{asset('images/validation.png')}}" alt="" class="my-img">                                          
                                                                </div>  
                                                            @else
                                                                @if ($item->admin_action == 0) 
                                                                    <div class=" stat-p">
                                                                        <img src="{{asset('images/watch.png')}}" alt="" class="my-img">                                          
                                                                    </div>
                                                                @else
                                                                    <div class=" stat-p">
                                                                        <img src="{{asset('images/reject.png')}}" alt="" class="my-img">                                          
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </td>
                        
                                                        <td>
                                                            <div class="voir">
                                                                <a href="{{ route('show', $item) }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                    @endforeach 
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th> <b>Employés</b></th>
                                                        <th><b>E-mail</b></th>
                                                        <th><b>Statut</b></th>
                                                        <th><b>Voir</b></th>
                                                    </tr>
                                                </tfoot>
                                            </table>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-enCours" role="tabpanel" aria-labelledby="pills-enCours-tab"> 
                            <div id="showAsk" class="row mt-3">
                                <div class="col-md-12 col-lg-12">  
                                    <div class="card enCour-b">
                                        <div class="title-banner">
                                            <div class="title">
                                                <h4>En cours</h3>
                                            </div>
                                        </div>
                                        <div class="table-b">
                                            <table id="scdTable" class="display mt-3" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th> <b>Employés</b></th>
                                                        <th><b>Type</b></th>
                                                        <th><b>Date debut et fin</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($enCours as $item)
                                                        
                                                    <tr>
                                                        <td>{{$item->name}}</td>
                                                        <td>{{$item->type}}</td>
                                                        <td> 
                                                            <p>{{$item->debut}}</p>
                                                            <p>{{$item->fin}}</p> 
                                                        </td>
                                                    </tr>
                                                    @endforeach 
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th> <b>Employés</b></th>
                                                        <th><b>Type</b></th>
                                                        <th><b>Date debut et fin</b></th>
                                                    </tr>
                                                </tfoot>
                                            </table>  
                                    </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-archive" role="tabpanel" aria-labelledby="pills-archive-tab"> 
                            <div  id="showAsk" class="row mt-3">
                                <div class="col-md-12 col-lg-12">  
                                    <div class="txt"> 
                                        <div class="card bonus-b">
                                            <div class="title-banner" style="height: 50px, padding-top: 5px">
                                                <div class="title">
                                                    <h4 >Bonus</h3>
                                                </div>
                                            </div>
                                            <div class="table-b">
                                                <table id="myTable" class="display mt-3" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th><b>Employe</b></th>
                                                            <th><b>Type</b></th>
                                                            <th><b>Dates</b></th>
                                                            <th><b>Envoyé le</b></th>
                                                            <th><b>voir</b></th>
                                                        </tr>
                                                    </thead>
                                                    {{-- <tbody>
                                                        @foreach ($attentes as $item)
                                                            
                                                        <tr>
                                                            <td>{{$item->name}}</td>
                                                            <td>{{$item->type}}</td>
                                                            <td> 
                                                                <p>{{$item->debut}}</p>
                                                                <p>{{$item->fin}}</p> <div class="l"></div>
                                                            </td>
                                                            <td>
                                                                <p>{{$item->created_at}}</p>
                                                            </td>
                                                            <td>
                                                                <div class="voir">
                                                                    <a href="{{ route('showRead', $item) }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                                                                </div> 
                                                            </td>
                                                        </tr>
                                                        @endforeach 
                                                        
                                                    </tbody> --}}
                                                    <tfoot>
                                                        <tr>
                                                            <th><b>Employe</b></th>
                                                            <th><b>Type</b></th>
                                                            <th><b>Dates</b></th>
                                                            <th><b>Statut</b></th>
                                                            <th><b>voir</b></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>   
                                            </div>
                                        </div>
                                    </div>  
                                </div> 
                            </div>
                        </div>
                  </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
   