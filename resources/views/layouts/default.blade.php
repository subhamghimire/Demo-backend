<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="noindex, nofollow">

    <title>{{ config('app.name') ? config('app.name') : '' }}</title>

    <!-- Style sheets-->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

    <style>
        #toast-container {
            margin-top: 10px !important;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"  rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://kit.fontawesome.com/7362fdfc7d.js" crossorigin="anonymous"></script>

</head>

<body>
<div id="app">

    <div class="col-10 offset-1 mb-5">
        <div class="d-flex align-items-center py-4 header">
            <a href="/"><img src="{{asset('storage/nea.png')}}" width="80"></a>
            <h4 class="mb-0 ml-3"><strong>{{ config('app.name') ? config('app.name') : '' }}</strong></h4>
        </div>

        @if (Session::has('message'))
            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-success">
                        <strong>{!! Session::get('message') !!}</strong>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mt-4">
            <div class="col-2 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="/"
                           class="{{ Route::is('admin/') ? 'active ' : '' }}nav-link d-flex align-items-center pt-0">
                            <i class="fas fa-home"></i> &nbsp;&nbsp;
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/users"
                           class="{{ Route::is('users*') ? 'active ' : '' }}nav-link d-flex align-items-center">
                            <i class="fas fa-users"></i> &nbsp;&nbsp;
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="/nav-item">
                        <a href="#"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                           class="nav-link d-flex align-items-center">
                            <i class="fas fa-sign-out-alt"></i> &nbsp;&nbsp;
                            <span>Log Out</span>
                        </a>
                        @include('forms.logout')
                    </li>
                    <li class="nav-item pt-5" style="font-size: 13px;">
                        <strong><a href="/">&copy; {{ date('Y') }} NEA</a></strong><br>
                    </li>
                </ul>
            </div>
            <div class="col-10">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="{{asset(mix('js/app.js'))}}"></script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script>
    $(document).ready(function() {
        toastr.options = {
            "positionClass" : "toast-top-center",
            "closeButton" : true,
            "debug" : false,
            "newestOnTop" : true,
            "progressBar" : true,
            "preventDuplicates" : false,
            "onclick" : null,
            "showDuration" : "300",
            "hideDuration" : "1000",
            "timeOut" : "5000",
            "extendedTimeOut" : "1000",
            "showEasing" : "swing",
            "hideEasing" : "linear",
            "showMethod" : "fadeIn",
            "hideMethod" : "fadeOut"
        }
        @if(Session::has('success'))
            toastr['success']("{{ Session::get('success') }}")
        @endif
            @if(Session::has('warning'))
            toastr['warning']("{{ Session::get('warning') }}")
        @endif
            @if(Session::has('error'))
            toastr['error']("{{ Session::get('error') }}")
        @endif
        $("#textEditor").Editor();
    });
    $(document).ready(function() {
        $('.select2').select2(
            {'multiple':true}
        );
    });
</script>
@yield('scripts')
@yield('footer')
</body>

</html>
