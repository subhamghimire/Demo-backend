@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-12">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <a class="btn btn-secondary" href="{{ action('QuestionController@index') }}">
                                <i class="fas fa-arrow-circle-left"></i>
                            </a>
                            <button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                <strong>
                                    Edit: {{ $question->id }}
                                </strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form method="post" action="{{ action('QuestionController@update',$question->id) }}" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    @method('put')
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="title"
                                                   class=" col-md-12 col-form-label text-md-left">{{ __('Title') }}</label>
                                            <div class="col-md-12">
                                                <input id="title" type="text" readonly
                                                       class="form-control @error('title') is-invalid @enderror" name="title"
                                                       value="{{ $question->title }}" required autocomplete="off" autofocus>
                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="excerpt"
                                                   class="col-md-12 col-form-label text-md-left">{{ __('Date') }}</label>
                                            <div class="col-md-12">
                                                <input id="date" type="text" readonly
                                                       class="form-control @error('date') is-invalid @enderror" name="date"
                                                       value="{{ $question->date }}" required autocomplete="off" autofocus>
                                                @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="answer"
                                                   class="col-md-12 col-form-label text-md-left">{{ __('Answer') }}</label>
                                            <div class="col-md-12">
                                                <input id="answer" type="text"
                                                       class="form-control @error('answer') is-invalid @enderror" name="answer"
                                                        required autocomplete="off" autofocus>
                                                @error('answer')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <button class="btn btn-success">Update Question</button>
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


    <script>
        $(document).ready(function() {

        });

    </script>
@endsection
