
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SpyActivities') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:ital@1&display=swap" rel="stylesheet"> 
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
      <div id="menu">
          <div class="horiz-bar">
              <div class="nav-c">
                  {{-- <div class="bar">
                      <div class="icon">
                          <i class="fas fa-bars"></i>
                      </div>
                  </div> --}}
                  <div class="notif">
                      <div class="icon">
                          <i class="fas fa-bell"></i>
                      </div>
                  </div>
              </div>
          </div>
            <div class="vertical-bar">
                <header>
                    <div class="logo">
                        <img src="{{asset('images/logo.png')}}" alt="" class="img-fluid">
                    </div>
                </header>

                <div class="profil-info">
                    <div class="img-p">
                        @if (Auth::user()->avatar == NULL) 
                        <img src="{{asset('images/avatar/woman_avatar.png')}}" alt="" class="my-img image">
                        @else
                        <img src="{{asset('storage/'.Auth::user()->avatar)}}" alt="" class="my-img image">
                        @endif
                    </div>
                    <div class="info-p">
                        <b>{{ Auth::user()->name }}</b>
                        <p>{{ Auth::user()->role }}</p>
                    </div>
                </div>
                @if (Auth::user()->role == 'admin')
                    @include('partials._adminMenu')
                @else
                    @if (Auth::user()->role == 'employe')
                        @include('partials._empMenu')
                    @else
                        @include('partials._managerMenu')  
                    @endif
                @endif
            </div>
      </div>
      <main class="main-c">
        @yield('content')
      </main>
      <script src="https://code.jquery.com/jquery-3.5.1.js"  type="application/javascript"></script> 
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"></script>
      {{-- <script src="http://cdn.datatables.net/plug-ins/1.10.9/i18n/French.json."></script> --}}
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
      {{-- <script src="bootstrap-datepicker.FR.js" charset="UTF-8"></script>
      <script type="text/javascript">
            $(function () {
            $('#datetimepicker1').datetimepicker({locale:'es'});
            });
      </script> --}}
      <script  type="text/javascript">
              
            $(function () {

                    $.fn.datepicker.dates['fr'] = {
                    days: ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"],
                    daysShort: ["dim.", "lun.", "mar.", "mer.", "jeu.", "ven.", "sam."],
                    daysMin: ["d", "l", "ma", "me", "j", "v", "s"],
                    months: ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
                    monthsShort: ["janv.", "févr.", "mars", "avril", "mai", "juin", "juil.", "août", "sept.", "oct.", "nov.", "déc."],
                    today: "Aujourd'hui",
                    monthsTitle: "Mois",
                    clear: "Effacer",
                    weekStart: 1,
                    format: "dd-mm-yyyy"
                };
                }(jQuery));
                $(".datepicker").datepicker({ 
                    language: 'fr',
                    autoclose: true, 
                    todayHighlight: true
                });
          
      </script>
      <script  type="application/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable( {
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
                "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}

            } );
            $('.datepicker').datepicker();
            
        } );
      </script>

      <script  type="application/javascript">
        $(document).ready(function() {
            $('#myTablee').DataTable( {
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
                "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}

            } );
            $('.datepicker').datepicker();
            
        } );
      </script>

      <script  type="application/javascript">
        $(document).ready(function() {
            $('#scdTable').DataTable( {
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
                "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}
            } );
        } );
      </script>

      <script  type="application/javascript">
        $(document).ready(function() {
            $('#lastTable').DataTable( {
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
                "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}
            } );
        } );
      </script>

      {{-- <script>
          $(document).ready(function ()

            var table = $('#tblUsuarios').DataTable({
           aoColumnDefs: [
               {"aTargets": [0], "bSortable": true},
               {"aTargets": [2], "asSorting": ["asc"], "bSortable": true},
           ],
           "language": {
               "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
           }

            });
        
         );
      </script> --}}

      <script  type="application/javascript">
        $(document).ready(function() {
            $('#trdTable').DataTable( {
                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
                "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"}
            } );
            
        } );
      </script>
      {{-- <script  type="application/javascript">
      
        $(window).load(function(){        
            $('#myModal').modal('show');
        }); 

    </script> --}}
      <script type="application/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                $('.image').hide();

                $('.image').attr('src', e.target.result);
                $('.image').show();

                $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
            }
        }
    </script>
  </div>
</body>
</html>
