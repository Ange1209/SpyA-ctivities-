<nav id="emp" class="menu-list">
    <ul>
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
            <a href="{{ route('showDemande') }}" class="">
                <div class="icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="txt">
                    <b>Demandes</b>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('allBonus') }}" class="">
                <div class="icon">
                    <i class="fas fa-gifts"></i>
                </div>
                <div class="txt">
                    <b>Bonus</b>
                </div>
            </a>
        </li>

        <li>
            <a href="{{ route('paramUser') }}" class="">
                <div class="icon">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="txt">
                    <b>Parametres</b>
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
        </li>
    </ul>
</nav>