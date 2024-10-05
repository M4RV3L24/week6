@extends('base')

@section('libray-css')
<link href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <h1>List Walks</h1>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger">
                    + Create
                </button>
            </div>
        </div>
        <!-- Table with walks data -->
        {{ $walks }}
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
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->id }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('library-js')
<script type="text/javascript" src="//cdn.datatables.net/2.1.8/js/dataTables.min.js" />
@endsection