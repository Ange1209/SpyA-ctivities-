<nav id="emp" class="menu-list">
    <ul class="">
        <li class=" ">
            <a href="{{ route('dashboard') }}" class="">
                <div class="icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="txt ">
                    <b>Dashborad</b>
                </div>
            </a>
        </li>
        <li class="">
            <a href="{{ route('employe') }}" class="">
                <div class="icon">
                    <i class="fas fa-user"></i>      
                </div>
                <div class="txt">
                    <b>Employés</b>
                </div>
            </a>
        </li> 

        <li class="nav-item dropdown" >
            <a href="" class="">
                <div class="icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <a class="nav-link dropdown-toggle txt" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                <div>
                    <b>Demandes</b>
                </div>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item text-center" href="{{ route('showDemande') }}">Mes demandes</a>
                    <a class="dropdown-item" href="{{ route('showAllAsk') }}">Demandes du departement</a>
                </div>
            </a>
        </li> 
        <li class="nav-item dropdown">
            <a href="" class="">
                <div class="icon">
                    <i class="fas fa-gifts"></i>
                </div>
                <a class="nav-link dropdown-toggle txt" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                <div>
                    <b>Bonus</b>
                </div>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item text-center" href="{{ route('allBonus') }}">Mes bonus</a>
                    <a class="dropdown-item" href="{{ route('depBonus') }}">Bonus du departement</a>
                </div>
            </a>
        </li> 

        {{-- <li class="">
            <a href="{{ route('showDemande') }}" class="">
                <div class="icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="txt">
                    <b>Demandes</b>
                </div>
            </a>
        </li> --}}
        {{-- <li>
            <a href="" class="">
                <div class="icon">
                    <i class="fas fa-gifts"></i>
                </div>
                <div class="txt">
                    <b>Bonus</b>
                </div>
            </a>
        </li> --}}

        <li>
            <a href="{{ route('paramUser') }}" class="">
                <div class="icon">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="txt">
                    <b>Parametre</b>
                </div>
            </a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">

                     <div class="icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <div class="txt">
                        <b>Deconnexion</b>
                    </div>
                </a>
            </form>
            {{-- <a href="{{ route('logout') }}" class="">
                <div class="icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="txt">
                    <b>Deconnexion</b>
                </div>
            </a> --}}
        </li>
    </ul>
</nav>