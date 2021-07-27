@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Teachers') }}</div>

                <div class="card-body">
                @if ($user->role == 1)
                   <h3 class="text-dark"> {{$user->name}} is a teacher</h3>
                @else
                <h3 class="text-dark"> {{$user->name}} is a student</h3>
                @endif
                </div>
            </div>
        </div>
    </div>



    {{-- teacher code --}}


    @if ($user->role == 1)

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('His own period') }}</div>
                <div class="card-body">
                    @if ($user->period != null)
                    <a href="{{route('period.drtails', $user->period)}}" class="text-dark">{{$user->period->name}}</a>
                @else
                <h3>Currently he has not any period</h3>
                @endif
                </div>
            </div>
        </div>
    </div>




    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('He teaches in') }}</div>

                <div class="card-body">
                  
                   @if ($user->teachersperiods->count())
                   @foreach ($user->teachersperiods as $period)
                   <a href="{{route('period.drtails', $period->period)}}" class="text-dark">{{$period->period->name}}</a>
                   @endforeach
                   @else
                   <h3>Currently he is not teaching anywhere</h3>
                   @endif

                </div>
            </div>
        </div>
    </div>
</div>
    @else
    {{-- student code --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('He learning in') }}</div>

                <div class="card-body">
                  
                     
                    @if ($user->studentsperiods->count())
                    @foreach ($user->studentsperiods as $period)
                    <a href="{{route('period.drtails', $period->period)}}" class="text-dark">{{$period->period->name}}</a>
                    @endforeach
                    @else
                    <h3>Currently he is not reading anywhere</h3>
                    @endif
                 
                </div>
            </div>
        </div>
    </div>
</div>
    @endif





    
@endsection
