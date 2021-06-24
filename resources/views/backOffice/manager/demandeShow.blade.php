@extends('layouts.app')

<?php $currentPage = 'samira';?>


@section('content')

<div class="container pt-2">
    <div class="card showAsk-c">
        <div class="ul-p">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-attente-tab" data-toggle="pill" href="#pills-attente" role="tab" aria-controls="pills-attente" aria-selected="true">En attente de validation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-enCours-tab" data-toggle="pill" href="#pills-enCours" role="tab" aria-controls="pills-enCours" aria-selected="false">En cours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-archive-tab" data-toggle="pill" href="#pills-archive" role="tab" aria-controls="pills-archive" aria-selected="false">Archives</a>
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
            <div class="tab-pane fade" id="pills-enCours" role="tabpanel" aria-labelledby="pills-enCours-tab"> 
                <div id="showAsk" class="row mt-3">
                    <div class="col-md-12 col-lg-12">  
                        <div class="card enCour-b">
                            <div class="title-banner">
                                <div class="title">
                                    <h4>En cours</h3>
                                </div>
                            </div>
                            @if ($enCours->count() == 0)
                                <div class="cours-null">
                                    <h5 class="text-center mt-3 mb-3">
                                        Aucune demande en attente
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
                            <div class="card archiv-b">
                                <div class="title-banner" style="height: 50px, padding-top: 5px">
                                    <div class="title">
                                        <h4 >Archives</h3>
                                    </div>
                                </div>
                                @if ($demandes->count() == 0)
                                    <div class="cours-null">
                                        <h5 class="text-center mt-3 mb-3">
                                            Aucune demande enregistrée
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
                                                    <th><b>Statut</b></th>
                                                    <th><b>voir</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($demandes as $item)
                                                    
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
                                                            @endif
                                                        @endif
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
          </div>
    </div>
</div>

@endsection
   