@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Teachers') }}</div>

                <div class="card-body">
                  
                    @if ($teachers->count())
                        @foreach ($teachers as $teacher)
                        
                        <div class="d-flex justify-content-start align-items-center">
                            <a href="
                            @if ($teacher->id == auth()->user()->id)
                            {{ route('admin.period') }}
                            @else
                            {{route('show.teacher.student.details', $teacher)}}
                            @endif
                            " class="text-dark">{{$teacher->name}}  @if ($teacher->id == auth()->user()->id)
                            <span class="text-success"> Me</span>
                            @endif</a>
                        </div>
                        
                        @endforeach
                  
                        {{$teachers->links()}}
                        
                    @endif
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
