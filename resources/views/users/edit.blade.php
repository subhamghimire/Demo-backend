@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-12">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <a class="btn btn-secondary" href="{{ action('UserController@index') }}">
                                <i class="fas fa-arrow-circle-left"></i>
                            </a>
                            <button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                <strong>
                                    Edit: {{ $user->name }}
                                </strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form method="post" action="{{ action('UserController@update',$user->id) }}">
                                <div class="row">
                                    @csrf
                                    @method('put')
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="name"
                                                   class=" col-md-12 col-form-label text-md-left">{{ __('Name') }}</label>
                                            <div class="col-md-12">
                                                <input id="name" type="text"
                                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                                       value="{{ $user->name }}" required autocomplete="off" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="phone"
                                                   class="col-md-12 col-form-label text-md-left">{{ __('Phone Number') }}</label>

                                            <div class="col-md-12">
                                                <input id="phone" type="number"
                                                       class="form-control @error('number') is-invalid @enderror" name="phone"
                                                       value="{{  $user->phone }}" required autocomplete="off" autofocus>

                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="email"
                                                   class="col-md-12 col-form-label text-md-left">{{ __('Email') }}</label>
                                            <div class="col-md-12">
                                                <input id="email" type="text"
                                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                                       value="{{ $user->email }}" required autocomplete="off" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="password"
                                                   class="col-md-12 col-form-label text-md-left">{{ __('Change Password') }}</label>
                                            <div class="col-md-12">
                                                <input id="password" type="password" placeholder="leave empty to keep old password"
                                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                                       autocomplete="off" autofocus>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <button class="btn btn-success">Update User</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"  rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />


    <script>
        $(document).ready(function() {
            $('#role').on('change', function() {
                if($(this).val() == '1'){
                    console.log($('.topic'));
                    $('.topic').hide();
                }else{
                    $('.topic').show();
                }
            });
        });

    </script>
@endsection
