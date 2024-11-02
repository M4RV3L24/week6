@extends('base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('owners.index') }}">
                    <button class="btn btn-sm mt-1" style="float:left;">
                        <i class="fa-solid fa-2x fa-circle-left"></i>
                    </button>
                </a>
                <h1>Owner</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <span class="fw-bold">Owner name</span>
                <p>{{ $ownerData->name }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <span class="fw-bold">Created at</span>
                <p>
                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ownerData->created_at)->format('d F Y H:i:s') }}
                </p>
                <span class="fw-bold">Updated at</span>
                <p>
                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ownerData->updated_at)->format('d F Y H:i:s') }}
                </p>
            </div>
        </div>
    </div>
@endsection