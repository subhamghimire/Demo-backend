@extends('layouts.default')
@section('content')
    <div class="card mt-4">
        <div class="card-header">
            <h5>All Questions ({{ $questions->count() }})</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped mb-0 " id="dataTable"  style="width:100%" >
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Author Name</th>
                    <th>Answer</th>
                    <th width="200">Give Answer</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($questions as $key=>$question)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $question->date }}</td>
                        <td>{{ $question->title }}</td>
                        <td>{{ $question->user->name }}</td>
                        <td>{{ $question->answer ?? '' }}</td>
                        <td>
                            <a class="btn btn-sm btn-secondary"
                               href="{{ action('QuestionController@edit', $question->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"  rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {
            console.log("done");

            $('#dataTable').DataTable({
                "bPaginate":true
            });

        });

    </script>
    @endsection
