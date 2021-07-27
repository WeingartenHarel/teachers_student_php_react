@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <form action="{{ route('student.profile.update') }}" method="post">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" class="form-control" name="email" value="{{ auth::user()->email }}">
                        </div>     
                        <input type="submit" class="btn btn-primary">                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
