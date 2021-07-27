@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @foreach ($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                 @endforeach 

                    <form action="{{ route('student.password.update') }}" method="post">
                        <div class="form-group">
                            <label for="">Current Password</label>
                            <input type="password" class="form-control" name="current_password" >
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" class="form-control" name="new_password" >
                        </div>
                        <div class="form-group">
                            <label for="">Confirm new Password</label>
                            <input type="password" class="form-control" name="new_confirm_password" >
                        </div>     
                        <input type="submit" class="btn btn-primary">                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
