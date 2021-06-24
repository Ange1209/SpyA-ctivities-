@extends('layouts.app')

@section('content')

<div class="container">
    <div id="parUser" >
        <div class="mt-2">
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
        <div id="param-c" class="row justify-content-center" >
            <div class="col-md-6 col-lg-5">
                <div class="first-b">
                    <form action="{{ route('storeImage', $user) }}" method="post"  enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="card img-p">
                            <img class=" my-img" src="{{asset('images/user.png')}}" alt="your image"/>
                            <div class="avatar">
                                @if (Auth::user()->avatar == NULL) 
                                <img src="{{asset('images/avatar/woman_avatar.png')}}" alt="" class="my-img image">
                                @else
                                <img class="image my-img" src="{{asset('storage/'.$user->avatar)}}" alt="your image" />
                                @endif
                                <div class="add-img">
                                    <div class="icon">
                                        <input type="file" id='imag' class="imag" name="avatar" onchange="readURL(this);" accept="image/*" >
                                        <i class="fas fa-camera"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn save-img ">
                                <i class="fas fa-save"></i> {{ __('Sauvegarder') }} 
                            </button>
                        </div>
                    </form>   
                </div>    
            </div>

            <div class="col-md-6 col-lg-7">
                <div class="scd-b">
                    <div class="card confid">
                        <div class="confid-text">
                            <h3 class="display-6">Edition du profile</h3>
                            <b>Créé le : {{ \Carbon\Carbon::parse($user->created_date)->format('d-m-Y')}} </b>
                        </div>
                        <div class="confid-form ">
                            <button type="button" class="btn edit-btn" data-toggle="modal" data-target="#{{$user->uuid}}">
                                <i class="fas fa-key"></i>
                                Confidentialité
                            </button>
                        </div>
                    </div>
                    <div class="card input-c ">
                        <div class="form-b">
                            <form method="POST" action="{{ route('paramUserUpdate', $user) }}">
                                @method('PATCH')
                                @csrf
                                <div class="form-group w-100 mb-3">
                                    
                                    <div class="input-div ">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name}}" required autocomplete="name" autofocus>
                                        
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="name" class="form-label">{{ __('Nom') }}</label>
                                    </div>
                                </div>
                                
                                <div class="form-group w-100 mb-3">
                                    <div class="input-div">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email}}" required autocomplete="email">
                                        
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="email" class="form-label">{{ __('E-Mail') }}</label>
                                    </div>
                                </div>
                                <div class="form-group w-100 mb-3">
                                    <div class="input-div">
                                        <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $user->phone}}" required autocomplete="phone">
                                        
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="phone" class="form-label">{{ __('Telephone') }}</label>
                                    </div>
                                </div>
            
                                <div class="form-group w-100 row ">
                                    <button type="submit" class="btn save-img ">
                                        <i class="fas fa-edit"></i>
                                        {{ __('Editer') }}
                                       
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>    
                
            </div>
        </div>   
         
    </div>    
</div>

<div class="modal fade" id="{{$user->uuid}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b><h4 class="modal-title" id="exampleModalLabel">Modifier votre mot de passe</h4></b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body conf-pwd">
                <form action="{{ route('pwdUpdate', $user) }}" method="post">
                    @csrf
                    @method('PATCH')
                
                    <div class="form-group w-100 mb-3">
                                        
                        <div class="input-div">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password">
                            
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="password" class="form-label">{{ __('Ancien mot de passe') }}</label>
                        </div>
                    </div>
    
                    <div class="form-group w-100 mb-3">
                        
                        <div class="input-div">
                            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new_password">
                            
                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="new_password" class="form-label">{{ __('Nouveau mot de passe') }}</label>
                        </div>
                    </div>
    
                    <div class="form-group w-100">
                        
                        <div class="input-div">
                            <input id="password-confirm" type="password" class="form-control" name="new_password_confirmation" required autocomplete="new_password_confirmation">
                            <label for="new_password-confirm" class="form-label">{{ __('Confirmer le mot de passe') }}</label>
                        </div>
                    </div>              
                    
                    <div class="form-group w-100 row ">
                        <button type="submit" class="btn edit-btn">
                            <i class="fas fa-edit"></i>
                            {{ __('Editer') }}
                           
                        </button>
                    </div>
                                  
                </form>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn close-btn" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div> 
@endsection
   