@extends('base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 mx-auto py-5">
                <form action="{{ route('authenticate') }}" method="POST">
                    @csrf
                    <div class="form-group pb-2">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>
                    <div class="form-group pb-3">
                        <label for="email">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection