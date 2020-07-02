@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-12">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed text-dark" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <strong>Add News</strong>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse {{$errors->count() ? 'show':''}}" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body ">
                            <form method="post" action="{{ action('NewsController@store') }}" id="submitForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label for="title"
                                                   class="col-md-12 col-form-label text-md-left">{{ __('Title') }}</label>
                                            <div class="col-md-12">
                                                <input id="title" type="text"
                                                       class="form-control @error('title') is-invalid @enderror" name="title"
                                                       value="{{ old('title') }}" required autocomplete="off" autofocus>
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
                                                   class="col-md-12 col-form-label text-md-left">{{ __('Excerpt') }}</label>
                                            <div class="col-md-12">
                                                <input id="excerpt" type="text"
                                                       class="form-control @error('excerpt') is-invalid @enderror" name="excerpt"
                                                       value="{{ old('excerpt') }}" required autocomplete="off" autofocus>
                                                @error('excerpt')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="body1"
                                                   class="col-md-12 col-form-label text-md-left">{{ __('Body') }}</label>
                                            <div class="col-md-12">
                                                <textarea id="textEditor" name="body1"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <input type="hidden" name="body" id="body">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">{{ __('Image') }}</label>
                                            <input id="image" type="file"
                                                   class="form-control-file @error('image') is-invalid @enderror" name="image">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <button class="btn btn-success">Add New News</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <div class="card mt-4">
            <div class="card-header">
                <h5>All News ({{ $news->count() }})</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped mb-0" id="dataTable"  style="width:100%" >
                    <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Author Name</th>
                        <th>Title</th>
                        <th>Excerpt</th>
                        <th>Image</th>
                        <th width="200">Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($news as $key=>$new)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $new->author->name }}</td>
                            <td>{{ $new->title }}</td>
                            <td>{{ $new->excerpt }}</td>
                            @if ($new->image)
                        <td><a href="{{Storage::url($new->image)}}" target="_blank"> <img src="{{Storage::url($new->image)}}" width="80"></a></td>
                            @else
                                <td>No Image Available</td>
                            @endif
                            <td>
                                <form method="post" action="{{ action('NewsController@destroy', $new->id) }}">
                                    @csrf
                                @method('DELETE')
                                    <a class="btn btn-sm btn-secondary"
                                       href="{{ action('NewsController@edit', $new->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {


            $('#dataTable').DataTable({
                "bPaginate":true
            });

            $('#submitForm').on('submit',function () {
               var getText =  $("#textEditor").Editor("getText");
                $('#body').val(getText);
            })
        });

    </script>
    @endsection
