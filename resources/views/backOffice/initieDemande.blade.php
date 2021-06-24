@extends('layouts.app')

@section('content')

<div class="container">
    <div class="mt-2">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                
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
    
    <div id="parUser" class="col-12 col-md-12">
        <div id="param-c" class="row justify-content-center" >
            <div class="col-md-6 col-lg-5">
                <div class="ask-b">
                    <div class="card ask-img-p">
                        <img class=" my-img" src="{{asset('images/pene.png')}}" alt="your image" />
                        <div class="ask-img">
                            <img class=" my-img" src="{{asset('images/iniAsk.png')}}" alt="your image" />
                        </div>
                    </div> 
                </div>    
            </div>
            <div class="col-md-6 col-lg-7">
                <div class="ask-scd-b">
                    <div  class="card input-c ">
                        <div class="form-b">
                            <h4>{{ __('Initiez votre demande') }} </h4><br><br>
                            @if (Route::current()->getName() === 'initieDemande')
                            <form  action="{{ route('storeAsk') }}" method="POST" >
                                @else
                                <form  method="POST" action="{{ route('updateAsk', $demande) }}"> 
                                    {{ method_field('PATCH') }}
                                    @endif
                                    
                                    @csrf
                                    {{-- {{dd($demande->debut)}} --}}
                                    <div class="form-group w-100 mb-3">
                                        
                                        <div class="input-div ">
                                            <select id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type">
                                                {{-- <option value="Permission">Permission</option> --}}
                                                <option value="Permission">Permission</option>
                                                <option value="Justification">Justification</option>
                                            </select>
                                            @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <label for="type" class="form-label">{{ __('Type') }}</label>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group w-100 mb-3">
                                        <div class="input-div">
                                            <input id="debut" type="datetime" class="form-control  @error('debut') is-invalid @enderror" name="debut" value="{{ old('debut') ?? \Carbon\Carbon::parse($demande->debut)->format('d-m-Y H:i')}}" {{ $required }}>
                                            
                                            @error('debut')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <label for="debut" class="form-label">{{ __('Date-debut') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group w-100 mb-3">
                                        <div class="input-div">
                                            <input id="fin" type="datetime" class="form-control  @error('fin') is-invalid @enderror" name="fin" value="{{ old('fin') ?? \Carbon\Carbon::parse($demande->fin)->format('d-m-Y H:i')}}" {{ $required }}>
                                            
                                            @error('fin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <label for="fin" class="form-label">{{ __('Date-fin') }}</label>
                                        </div>
                                    </div>
                                  
                                    
                                    <div class="form-group w-100 mb-5">
                                        <div class="input-div">
                                            <textarea class="form-control @error('motif') is-invalid @enderror" id="motif" rows="3"   name="motif" value="{{ old('motif') ?? $demande->motif}}" {{ $required }}>{{ old('motif') ?? $demande->motif}}</textarea>
                                            @error('motif')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <label for="motif" class="form-label">{{ __('Motif') }}</label>
                                        </div>
                                    </div><br>
                                    
                                    <div class="form-group w-100 row">
                                        <button type="" class="btn save-img">
                                            <i class="far fa-paper-plane"></i>
                                            {{ __('Envoyer') }}
                                            
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
{{-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-5">
            <div class="car">
                data-toggle="modal" data-target="#myModal"
                <div class="modal-img">
                    <img class=" my-img" src="{{asset('images/envoyé.png')}}" alt="your image" />
                </div>
                  <h4>Votre demande a bien été envoyer et est en attente de validation</h4>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn close-btn" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div> --}}

@endsection
