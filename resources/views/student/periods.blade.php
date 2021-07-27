@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Period that I am learning in</div>
                <div class="card-body">
                    @if ($datas->count())
                        @foreach ($datas as $learn)
                        <form action="{{route('join.period', $learn->period->id)}}" method="POST"
                        class="d-flex justify-content-around align-items-center my-2">
                        @csrf
                            <div class="form-group">
                           <a href="#" class="text-dark">{{$learn->period->name}}</a>
                                    </div>            
                                    <input type="submit" class="btn btn-primary" value="Leave"/>                   
                                </form>
                        @endforeach
                        {{$datas->links()}}
                        @else
                        <h1>Currently your not taking any periods</h1>
                    @endif
            

                </div>
            </div>
        </div>
    </div>
</div>
@endsection