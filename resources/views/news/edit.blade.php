@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-12">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <a class="btn btn-secondary" href="{{ action('NewsController@index') }}">
                                <i class="fas fa-arrow-circle-left"></i>
                            </a>
                            <button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne">
                                <strong>
                                    Edit: {{ $news->name }}
                                </strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form method="post" action="{{ action('NewsController@update',$news->id) }}" id="submitForm" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    @method('put')
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="title"
                                                   class=" col-md-12 col-form-label text-md-left">{{ __('Title') }}</label>
                                            <div class="col-md-12">
                                                <input id="title" type="text"
                                                       class="form-control @error('name') is-invalid @enderror" name="title"
                                                       value="{{ $news->title }}" required autocomplete="off" autofocus>
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
                                                   class="col-md-12 col-form-label text-md-left">{{ __('Excerpt (Short Description)') }}</label>
                                            <div class="col-md-12">
                                                <input id="excerpt" type="text"
                                                       class="form-control @error('excerpt') is-invalid @enderror" name="excerpt"
                                                       value="{{ $news->excerpt }}" required autocomplete="off" autofocus>
                                                @error('excerpt')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <input hidden id="body2" name="body2" value="{{$news->body}}">

                                    <input hidden id="body" name="body">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="textEditor"
                                                   class="col-md-12 col-form-label text-md-left">{{ __('Body') }}</label>
                                            <div class="col-md-12">
                                                <textarea id="textEditor" name="body1"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">{{ __('Image') }}</label>
                                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ $news->image }}"  autocomplete="off" autofocus>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $message }}</strong>
		                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($news->image)
                                        <a href="{{Storage::url($news->image)}}" target="_blank"> <img src="{{Storage::url($news->image)}}" width="200"></a>
                                        @endif
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <button class="btn btn-success">Update News</button>
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
            var body = $('#body2').val()
            $("#textEditor").Editor("setText",body)

            $('#submitForm').on('submit',function () {
                var setText =  $("#textEditor").Editor("getText");
                $('#body').val(setText);
            })
        });

    </script>
@endsection
