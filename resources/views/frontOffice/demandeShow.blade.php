@extends('layouts.app')

<?php $currentPage = 'samira';?>


@section('content')
<div class="container pt-2">
    <div class="row justify-content-center">     
        <div class="col-md-12 col-lg-12 pl-3 pr-5">
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
    <div id="showAsk" class="row mt-3">
        {{-- <div class="col-md-8 col-lg-1">
        </div> --}}
        <div class="col-md-8 col-lg-4">
            <div class="card enCour-b">
                <div class="title-banner">
                    <div class="title">
                        <h4>En cours</h3>
                    </div>
                </div>
                @if ($today->count() == 0)
                    <div class="cours-null">
                        <h6 class="text-center">
                            Aucune demande en cours
                        </h6>
                    </div>
                @else     
                    @foreach ($today as $item)
                        <div class="askIn-p">
                            <div class="img-p">
                                <img src="{{asset('images/en_cours.png')}}" alt="" class="my-img ">
                            </div>
                            <div class="txt">
                                <p class="text-capitalize">Type : {{$item->type}} </p>
                                <p>Debut :{{$item->debut}}</p>
                                <p>Fin :{{$item->fin}}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="card wait-b">
                <div class="title-banner">
                    <div class="title">
                        <h5 >En attente de validation</h3>
                    </div>
                </div>
                @if ($validation->count() == 0)
                    <div class="cours-null">
                        <h6 class="text-center">
                            Aucune demande en attente
                        </h6>
                    </div>
                @else     
                    @foreach ($validation as $item)
                        <div class="wait-p">
                            <div class="img-p">
                                <img src="{{asset('images/wait.png')}}" alt="" class="my-img ">
                            </div>
                            <div class="txt">
                                <p class="text-capitalize">Type : {{$item->type}} </p>
                                <p>{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y-H:i')}} </p>
                            </div>
                            <div class="voir">
                                <a href="{{ route('showRead', $item) }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                            </div> 
                        </div>
                    @endforeach
                @endif
                
            </div>
            <div class="initAsk-b">
                <div class="card">
                    <div class=" init">
                        <div class="img-circle">
                            <img src="{{asset('images/iniAsk.png')}}" alt="" class="my-img ">
                        </div>
                        <div class="buton">
                            <div class="btn init-btn">
                                <a href="{{ route('initieDemande') }}">
                                    Initier une demande
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        
        <div class="col-md-12 col-lg-8">  
            <div class="txt"> 
                <div class="card archiv-b">
                   <div class="title-banner">
                       <div class="title">
                           <h4 >Archives</h3>
                        </div>
                   </div>
                   @if ($demandes->count() == 0)
                        <div class="cours-null">
                            <h5 class="text-center">
                                Aucune demande en cours
                            </h5>
                        </div>
                   @else     
                    <div class="table-b">
                            <table id="myTable" class="display mt-3" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> <b>Type</b></th>
                                        <th><b>Envoyer le</b></th>
                                        <th><b>Statut</b></th>
                                        <th><b>Voir</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $item)
                                        
                                    <tr>
                                        <td class="text-capitalize">{{$item->type}}</td>
                                        <td>{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y-H:i')}} </td>
                                        <td>
                                            <p>{{$item->statut}}</p>
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
                                        <th> <b>Type</b></th>
                                        <th><b>Envoyer le</b></th>
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
@endsection
   