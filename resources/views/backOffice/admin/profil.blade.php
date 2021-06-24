
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
    <div id="admin-dash">
        <div class="row justify-content-center">
               <div class="col-12 col-md-6 col-lg-3">
                    <div class="card emp-b">
                        <div class="img-p">
                            <div class="icon-b">
                                <img src="{{asset('images/development.png')}}" alt="" class="my-img">
                            </div>
                        </div>
                        <div class="info-b">
                            <div class="title">
                                <h5> {{$deparTech->name}} </h5>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>Nombre d'employés</p>
                                </div>
                                <div class="count">
                                    {{$deparTech->users->count()}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>Permissions et justifications</p>
                                </div>
                                <div class="count">
                                    @php
                                        $tech=0;
                                        foreach ($deparTech->users as $user) {
                                            $tech=$tech+$user->demandes->count();
                                        }
                                    @endphp
                                    {{$tech}}
                                </div>
                            </div>
                            {{-- <div class="box" >
                                Responsable de la realisation des services offert par l entreprise
                            </div> --}}
                            <div class="title" >
                                <a href="{{ route('departement',$deparTech) }}">Plus de detatils</a>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="col-12 col-md-4 col-lg-3">
                    <div class="card emp-b">
                        <div class="img-p">
                            <div class="icon-b">
                                <img src="{{asset('images/accountant.png')}}" alt="" class="my-img">   
                            </div>
                        </div>
                        <div class="info-b">
                            <div class="title"  >
                                <h5>{{$deparComp->name}} </h5>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>Nombre d'employés</p>
                                </div>
                                <div class="count">
                                    {{$deparComp->users->count()}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>Permissions et justifications</p>
                                </div>
                                <div class="count">
                                    @php
                                        $compt=0;
                                        foreach ($deparComp->users as $user) {
                                            $compt=$compt+$user->demandes->count();
                                        }
                                    @endphp
                                    {{$compt}}
                                    
                                </div>
                            </div>
                            {{-- <div class="box" >
                                Responsable de l'evaluation des flux financier de l'entreprise
                            </div> --}}
            
                            <div class="title" >
                                <a href="{{ route('departement',$deparComp) }}">Plus de detatils</a>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="col-12 col-md-4 col-lg-3">
                    <div class="card emp-b">
                        <div class="img-p">
                            <div class="icon-b">
                                <img src="{{asset('images/social.png')}}" alt="" class="my-img">   
                            </div>
                        </div>
    
                        <div class="info-b">
                            <div class="title" >
                                <h5>{{$deparMarkt->name}} </h5>
                            </div>

                            <div class="box" >
                                <div class="title">
                                    <p>Nombre d'employés</p>
                                </div>
                                <div class="count">
                                    {{$deparMarkt->users->count()}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>Permissions et justifications</p>
                                </div>
                                <div class="count">
                                    @php
                                        $markt=0;
                                            foreach ($deparMarkt->users as $user) {
                                                $markt=$markt+$user->demandes->count();
                                            }
                                    @endphp
                                    {{$markt}}
                                </div>
                            </div>
                            {{-- <div class="box" >
                                Responsable de la satisfaction et de la mise en confiance de la clientele
                            </div> --}}
                            <div class="title" >
                                <a href="{{ route('departement',$deparMarkt) }}">Plus de detatils</a>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="col-12 col-md-4 col-lg-3">
                    <div class="card emp-b">
                        <div class="img-p">
                            <div class="icon-b">
                                <img src="{{asset('images/megaphone.png')}}" alt="" class="my-img">   
                            </div>
                        </div>
        
                        <div class="info-b">
                            <div class="title" >
                                <h5>{{$deparComu->name}} </h5>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>Nombre d'employés</p>
                                </div>
                                <div class="count">
                                    {{$deparComu->users->count()}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>Permissions et justifications</p>
                                </div>
                                <div class="count">
                                    @php
                                        $comu=0;
                                        foreach ($deparComu->users as $user) {
                                            $comu=$comu+$user->demandes->count();
                                            }
                                    @endphp
                                    {{$comu}}
                                </div>
                            </div>
                            <div class="title" >
                                <a href="{{ route('departement',$deparComu) }}">Plus de detatils</a>
                            </div>
                        </div>
                    </div> 
               </div>              
        </div>
        
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="card emp-b">
                    <div class="img-p">
                        <div class="icon-b">
                            <img src="{{asset('images/analysis.png')}}" alt="" class="my-img">   
                        </div>
                    </div>

                    <div class="info-b">
                        <div class="title" >
                            <h5>{{$deparRech->name}} </h5>
                        </div>

                        <div class="box">
                            <div class="title">
                                <p>Nombre d'employés</p>
                            </div>
                            <div class="count">
                                {{$deparRech->users->count()}}
                            </div>
                        </div>
                        <div class="box">
                            <div class="title">
                                <p>Permition et justifications</p>
                            </div>
                            <div class="count">
                                @php
                                $search=0;
                                    foreach ($deparRech->users as $user) {
                                        $search=$search+$user->demandes->count();
                                    }
                                @endphp
                                {{$search}}
                            </div>
                        </div>
                        {{-- <div class="box" >
                            Responsable du developpement progressif de l'entreprise
                        </div> --}}
                        <div class="title" >
                            <a href="{{ route('departement',$deparRech) }}">Plus de detatils</a>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-12 col-md-12 col-lg-9">
                <div class="card stat-b">
                  <div class="title-ban">
                      Statistiques
                  </div>
                  <div class="boxes">
                      <div class="img-p">
                          <div class="icon-b">
                            <img src="{{asset('images/team.png')}}" alt="" class="my-img">   
                        </div>
                      </div>

                      <div class="info-b">
                            <div class="title" >
                                <h5>Employés</h5>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>Employés actifs</p>
                                </div>
                                <div class="count">                                   
                                    {{$actif->count()}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>Nombre totale</p>
                                </div>
                                <div class="count">
                                    {{$users->count()}}
                                </div>
                            </div>
                      </div>
                      <div class="icon">
                        <div class="voir">
                            <a href="{{ route('employe') }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                        </div> 
                      </div>
                  </div>
                  <div class="boxes">
                      <div class="img-p">
                        <div class="icon-b">
                            <img src="{{asset('images/hand.png')}}" alt="" class="my-img">   
                        </div>
                      </div>
                      
                      <div class="info-b">
                            <div class="title" >
                                <h5>Bonus</h5>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>Déclarés</p>
                                </div>
                                <div class="count">
                                    {{$declaration->count()}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>Attribués</p>
                                </div>
                                <div class="count">
                                0
                                </div>
                            </div>
                     </div>

                     <div class="icon">
                        <div class="voir">
                            <a href="" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                        </div> 
                     </div>
                  </div>

                  <div class="boxes">
                      <div class="img-p">
                            <div class="icon-b">
                                <img src="{{asset('images/ask.png')}}" alt="" class="my-img">   
                            </div>
                      </div>
                     
                      
                      <div class="info-b">
                            <div class="title" >
                                <h5>Permissions et justifications</h5>
                            </div>
                            <div class="box" >
                                <div class="title">
                                    <p>En cours</p>
                                </div>
                                <div class="count">
                                    {{$enCours->count()}}
                                </div>
                            </div>
                            <div class="box">
                                <div class="title">
                                    <p>En attentes </p>
                                </div>
                                <div class="count">
                                    {{$attente->count()}}
                                </div>
                            </div>
                      </div>
                        <div class="icon">
                            <div class="voir">
                                <a href="{{ route('showAllAsk') }}" ><button class="btn voir-btn"><i class="far fa-eye"></i></button></a>
                            </div> 
                        </div>
                    </div>
                </div>
           </div>
          
        </div>
    </div>
  
</div>
@endsection