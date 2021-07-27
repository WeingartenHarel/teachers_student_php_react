@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Teachers') }}</div>

                <div class="card-body">
                  
                    @if ($students->count())
                        @foreach ($students as $student)
                        
                        <div class="d-flex justify-content-start align-items-center">

                            <a href="
                            @if ($student->id == auth()->user()->id)
                            {{route('student.own.periods', $student)}}
                            @else
                            {{route('show.teacher.student.details', $student)}}
                            @endif
                            
                            " class="text-dark">{{$student->name}}  
                                @if ($student->id == auth()->user()->id)
                            <span class="text-success"> Me</span>
                        @endif
                        </a>
                        </div>
                        @endforeach
                  
                        {{$students->links()}}
                        
                    @endif
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

