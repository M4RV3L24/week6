@extends('base')

@section('library-css')
<link href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <h1>List Walks</h1>
            </div>
            <div class="col-md-2 mt-2">
                <a href="{{ route('walks.create') }}">
                    <button type="button" class="btn btn-sm btn-danger">
                        + Create
                    </button>
                </a>
            </div>
        </div>
        <!-- Table with walks data -->
        <!-- {{ $walks }} -->
        <table id="walkData" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dog</th>
                    <th>Owner</th>
                    <th>Start At</th>
                    <th>Finished At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($walks as $data)                
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->dogOwner->dog->name }}</td>
                    <td>{{ $data->dogOwner->owner->name }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->started_at)->format('d F Y H:i:s') }}</td>
                    <td>
                        @if($data->finished_at)
                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data->finished_at)->format('d F Y H:i:s') }}
                        @else
                        -
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Action">
                            <a href="{{ route('walks.show', [ "walk" => $data->id ]) }}">
                                <button type="button" class="btn btn-sm btn-primary ml-1">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                            </a>
                            <a href="{{ route('walks.edit', [ "walk" => $data->id ]) }}">
                                <button type="button" class="btn btn-sm btn-warning mx-1">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                            </a>
                            <a href="{{ route('walks.destroy', [ "walk" => $data->id ]) }}">
                                <button type="button" class="btn btn-sm btn-danger ml-1">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('library-js')
<script type="text/javascript" src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $('#walkData').DataTable();
    } );
</script>
@endsection