@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Periods') }}</div>

                <div class="card-body">

                    @if (session('youCant'))
                        <h4 class="text-danger">{{@session('youCant')}}</h4>
                    @endif
              
                    @if ($periods->count())
                    @foreach ($periods as $period)
                    <div class="d-flex justify-content-around align-items center my-2">

                     <a href="{{route('period.drtails', $period)}}" class="btn btn-success">
                         {{$period->name}}
                    </a>


                  

                     <form 
                     @if ($period->user_id != auth()->user()->id)
                     action="{{route('join.period', $period)}}" method="POST"
                     @endif
                    >
                      

                        @if ($period->user_id != auth()->user()->id)
                        @csrf
                        <button class="btn btn-warning" type="submit">
                            @if (auth()->user()->role == 1)
                            @if ($period->teacherAlreadyJoinedOrNot(auth()->user()))
                                Leave
                             @else
                             Teach
                            @endif
                            
                            @else
                            @if ($period->studentAlreadyJoinedOrNot(auth()->user()))
                            Leave
                         @else
                         Join
                        @endif
                             
                            @endif
                         </button>

                         @else
                         <a href="{{route('period.drtails', $period)}}" class="btn btn-info">You own it</a>
                        @endif

                       
                    
                     </form>
                    </div>
                    @endforeach


                    {{$periods->links()}}

                   
                    @else
                    <h1 class="text-danger">
                    No periods available right now
                    </h1>
                    @endif
                   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
