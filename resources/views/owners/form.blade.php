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
                <h1>
                    @if (isset($id))
                        Edit
                    @else
                        Add
                    @endif
                    Owner
                </h1>
            </div>
        </div>
        <form action="{{ isset($id) ? route('owners.update', ['owner' => $id]) : route('owners.store') }}" method="POST">
            @csrf
            @if(isset($id))
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="form-label">Owner Name</label>
                    @if($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" value="{{ (isset($id))?$ownerData->name:'' }}" />
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <span class="fa fa-save"></span> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection