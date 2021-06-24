@extends('layouts.app')

@section('content')
<div class="container">
    <div  id="showUs">
        <div class="row justify-content-center">     
            <div class="col-md-12 col-lg-12 pl-5 pr-5">
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
        <div id="showUs-c" class="row justify-content-center">

            <div class="col-md-12 col-lg-4">
                @if (Auth::user()->role == 'employe')
                    <div class="img-bScd">
                        <div class="card showUs-av ">
                            <div class="img-show-us">
                                <div class="circle">
                                    @if ($users->avatar == NULL) 
                                        <img src="{{asset('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                    @else
                                        <img class="my-img" src="{{asset('storage/'.$users->avatar)}}" alt="your image" />
                                    @endif
                                </div>    
                            </div>
                        </div>
                    </div>  
                @else
                    <div class="img-b">
                        <div class="card showUs-av ">
                            <div class="img-show-us">
                                <div class="circle">
                                    @if ($users->avatar == NULL) 
                                        <img src="{{asset('images/avatar/woman_avatar.png')}}" alt="" class="my-img ">
                                    @else
                                        <img class="my-img" src="{{asset('storage/'.$users->avatar)}}" alt="your image" />
                                    @endif
                                </div>    
                            </div>
                        </div>
                    </div>    
                    <div class="card edit">
                        <div class="tit-ban">
                            <h5> <i class="fas fa-edit"></i> Editer </h5>
                        </div>

                        <div class="edit-b">
                            <div class="rol">
                                <h5>Role</h5>
                                <form action="{{ route('role', $users->uuid) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    @if ( Auth::user()->role == 'admin')
                                        @if ($users->role == 'admin')
                                            <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rol" id="exampleRadios1" value="employe"   required >
                                                    <label class="form-check-label" for="exampleRadios1">
                                                    Employé
                                                    </label>
                                            </div>
                                            <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rol" id="exampleRadios2" value="manager"  required >
                                                    <label class="form-check-label" for="exampleRadios2">
                                                    Manager
                                                    </label>
                                            </div>
                                            <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rol" id="exampleRadios3" value="admin" checked required  >
                                                    <label class="form-check-label" for="exampleRadios3">
                                                    Admin
                                                    </label>
                                            </div>
                                        @else
                                            @if ($users->role == 'manager')
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rol" id="exampleRadios1" value="employe" required >
                                                    <label class="form-check-label" for="exampleRadios1">
                                                    Employé
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rol" id="exampleRadios2" value="manager" checked required >
                                                        <label class="form-check-label" for="exampleRadios2">
                                                        Manager
                                                        </label>
                                                </div>
                                                <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rol" id="exampleRadios3" value="admin" required  >
                                                        <label class="form-check-label" for="exampleRadios3">
                                                        Admin
                                                        </label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rol" id="exampleRadios1" value="employe" checked required >
                                                    <label class="form-check-label" for="exampleRadios1">
                                                    Employé
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rol" id="exampleRadios2" value="manager"  required >
                                                        <label class="form-check-label" for="exampleRadios2">
                                                        Manager
                                                        </label>
                                                </div>
                                                <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rol" id="exampleRadios3" value="admin" required  >
                                                        <label class="form-check-label" for="exampleRadios3">
                                                        Admin
                                                        </label>
                                                </div>
                                            @endif
                                        @endif
                                            
                                    @else
                                        @if (Auth::user()->role == 'manager')
                                            @if ($users->role == 'manager')
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rol" id="exampleRadios1" value="employe" required >
                                                    <label class="form-check-label" for="exampleRadios1">
                                                    Employé
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rol" id="exampleRadios2" value="manager" checked required >
                                                        <label class="form-check-label" for="exampleRadios2">
                                                        Manager
                                                        </label>
                                                </div>
                                            @else
                                                
                                                <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rol" id="exampleRadios1" value="employe" checked  required >
                                                        <label class="form-check-label" for="exampleRadios1">
                                                        Employé
                                                        </label>
                                                </div>
                                                <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rol" id="exampleRadios2" value="manager"  required >
                                                        <label class="form-check-label" for="exampleRadios2">
                                                        Manager
                                                        </label>
                                                </div>
                                            @endif
                                
                                        @endif            
                                        
                                    @endif
                                    <div class="form-group">
                                        <button type="submit" class="btn voir-btn">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="button">
                                <h5>Statut</h5>
                                @if  ($users->admin_action == 0)
                                    <p>Veuillez activer l'utilisateur</p>
                                    <div class=" stat-p">
                                        <a href="{{ route('activation', $users->uuid) }}" >
                                            <img src="{{asset('images/on-button.png')}}" alt="" class="my-img">                                          
                                        </a>
                                    </div>  
                                
                                @else
                                    @if ($users->admin_action == 1)
                                        <p>Desactiver cet utilsateur </p>
                                        <div class=" stat-p">
                                            <a href="{{ route('bloquer', $users->uuid) }}" >
                                                <img src="{{asset('images/off-button.png')}}" alt="" class="my-img">                                          
                                            </a>
                                        </div>   
                                    @else
                                        <p>Veuillez activer cet utilisateur</p>
                                        <div class=" stat-p">
                                            <a href="{{ route('activation', $users->uuid) }}" >
                                                <img src="{{asset('images/on-button.png')}}" alt="" class="my-img">                                          
                                            </a>
                                        </div>   
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                {{-- <div class="user-p" style="position: fixed">
                </div> --}}
            </div>  



            <div class="col-md-12 col-lg-8">  
                <div class="txt"> 
                    @if (Auth::user()->role == 'employe')
                        <div class="card showUs-txt">
                            <div class="user-text">
                                <div class="header">
                                    <h4>{{$users->department->name}}</h4>
                                    <h4>{{$users->name}}</h4>
                                    <h5>{{$users->role}}</h5>
                                </div>

                                <div class="body">
                                    <div class="i-b">
                                        <div class=""><b>Email :</b> </div>
                                        <div class="ml-1">{{$users->email}}</div>
                                    </div>
                                    <div class="i-b">
                                        <div class=""><b>Telephone :</b> </div>
                                        <div class="ml-1">{{$users->phone}}</div>
                                    </div>
                                    <div class="i-b">
                                        <div class=""><b>Statut :</b> </div>
                                        <div class="ml-1">
                                            @if ($users->admin_action == 1)
                                                <div class=" stat-p">
                                                    <img src="{{asset('images/validation.png')}}" alt="" class="my-img">                                          
                                                </div>  
                                            @else
                                                @if ($users->admin_action == 0) 
                                                    <div class=" stat-p">
                                                        <img src="{{asset('images/watch.png')}}" alt="" class="my-img">                                          
                                                    </div>
                                                @else
                                                    <div class=" stat-p">
                                                        <img src="{{asset('images/reject.png')}}" alt="" class="my-img">                                          
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
        
                            </div>
                        </div>
                    @else      
                        <div class="card showUs-txt">
                            <div class="user-text">
                                <div class="header">
                                    <h4>{{$users->department->name}}</h4>
                                    <h4>{{$users->name}}</h4>
                                    <h5>{{$users->role}}</h5>
                                </div>

                                <div class="body">
                                    <div class="i-b">
                                        <div class=""><b>Email :</b> </div>
                                        <div class="ml-1">{{$users->email}}</div>
                                    </div>
                                    <div class="i-b">
                                        <div class=""><b>Telephone :</b> </div>
                                        <div class="ml-1">{{$users->phone}}</div>
                                    </div>
                                    <div class="i-b">
                                        <div class=""><b>Statut :</b> </div>
                                        <div class="ml-1">
                                            @if ($users->admin_action == 1)
                                                <div class=" stat-p">
                                                    <img src="{{asset('images/validation.png')}}" alt="" class="my-img">                                          
                                                </div>  
                                            @else
                                                @if ($users->admin_action == 0) 
                                                    <div class=" stat-p">
                                                        <img src="{{asset('images/watch.png')}}" alt="" class="my-img">                                          
                                                    </div>
                                                @else
                                                    <div class=" stat-p">
                                                        <img src="{{asset('images/reject.png')}}" alt="" class="my-img">                                          
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
        
                            </div>
                        </div>

                        <div class="card showUs-txt">
                            <div class="user-text">
                                <div class="header">
                                    <h4>Demandes & Bonus</h4>
                                </div>
                                <div class="ul-p">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-enCours-tab" data-toggle="pill" href="#pills-enCours" role="tab" aria-controls="pills-enCours" aria-selected="false">Permissions Justifications</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-archive-tab" data-toggle="pill" href="#pills-archive" role="tab" aria-controls="pills-archive" aria-selected="false">Bonus</a>
                                        </li>           
                                    </ul>
                                </div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-enCours" role="tabpanel" aria-labelledby="pills-enCours-tab"> 
                                        <div id="showAsk" class="row mt-3">
                                            <div class="col-md-12 col-lg-12">  
                                                <div class="card enCour-b">
                                                    <div class="title-banner">
                                                        <div class="title">
                                                            <h4>Permissions Justifications</h3>
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
                                                            <table id="scdTable" class="display mt-3" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th><b>Type</b></th>
                                                                        <th><b>Date debut et fin</b></th>
                                                                        <th><b>Statut</b></th>
                                                                        <th><b>Voir</b></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($demandes as $item)
                                                                        
                                                                    <tr>
                                                                        <td>{{$item->type}}</td>
                                                                        <td> 
                                                                            <p>{{$item->debut}}</p>
                                                                            <p>{{$item->fin}}</p> 
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
                                                                                <a href="{{ route('showRead', $item) }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                                                                            </div> 
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach 
                                                                    
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th><b>Type</b></th>
                                                                        <th><b>Date debut et fin</b></th>
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
                                                        @if ($bonus->count() == 0)
                                                            <div class="cours-null">
                                                                <h5 class="text-center mt-3 mb-3">
                                                                    Aucun bonus
                                                                </h5>
                                                            </div>
                                                        @else     
                                                            <div class="table-b">
                                                                <table id="myTable" class="display mt-3" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th><b>Type</b></th>
                                                                            <th><b>Dates</b></th>
                                                                            <th><b>Statut</b></th>
                                                                            <th><b>voir</b></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($bonus as $item)
                                                                            
                                                                        <tr>
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
                    @endif
                </div>     
            </div>
        </div>
    </div>    
</div>
@endsection
   