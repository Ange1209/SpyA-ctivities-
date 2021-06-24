@extends('layouts.app')

<?php $currentPage = 'samira';?>


@section('content')

<div class="container pt-2">
    <div class="card showAsk-c">
        <div class="ul-p">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-attente-tab" data-toggle="pill" href="#pills-attente" role="tab" aria-controls="pills-attente" aria-selected="true">Nouveaux inscrits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-enCours-tab" data-toggle="pill" href="#pills-enCours" role="tab" aria-controls="pills-enCours" aria-selected="false">Tous les employés</a>
                </li>    
            </ul>
        </div>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-attente" role="tabpanel" aria-labelledby="pills-attente-tab"> 
                <div  id="showAsk" class="row mt-3">
                    <div class="col-md-12 col-lg-12">  
                        <div class="card wait-b">
                            <div class="title-banner">
                                <div class="title">
                                    <h4>En attente d'activation</h3>
                                </div>
                            </div>
                            @if ($new->count() == 0)
                                <h4 class="text-center mb-3 mt-3">
                                    Aucun nouvel employé
                                </h4>
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
                                            @foreach ($new as $item)
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
                        <div class="card emp-b">
                            <div class="title-banner">
                                <div class="title">
                                    <h4>Employés</h3>
                                </div>
                            </div>
                            @if ($users->count() == 0)
                                <h4 class="text-center mb-3 mt-3">
                                    Aucun employé
                                </h4>
                            @else
                                <div class="table-b">
                                    <table id="scdTable" class="display mt-3" style="width:100%">
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
          </div>
    </div>
</div>

@endsection
   