@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">


                    @if ($msg=Session::get('message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                           {{ $msg }}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                    @endif
                    <h4>Welcome {{ auth::user()->name }}</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>                                
                            <th>Subject</th>
                            <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            <tr>
                                <td>Subject A</td>
                                <td>{{ auth::user()->subject_a }}</td>
                            </tr>
                            <tr>
                                <td>Subject B</td>
                                <td>{{ auth::user()->subject_b }}</td>
                            </tr>
                            <tr>
                                <td>Subject C</td>
                                <td>{{ auth::user()->subject_c }}</td>
                            </tr>
                            <tr>
                                <td>Subject D</td>
                                <td>{{ auth::user()->subject_d }}</td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
