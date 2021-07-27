@extends('layouts.app')
@section('content')




@if ($period->user_id == auth()->user()->id || $period->teacherAlreadyJoinedOrNot(auth()->user()))
    
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('update.period', $period)}}" method="POST">
              @csrf
              @method("PUT")
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Name of the period</label>
              <input type="text" class="form-control" id="recipient-name" name="periodnewname" value="{{$period->name}}">
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>
  
@endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$period->name}}
                @if (session('fraud'))
                    <h3 class="text-danger">{{@session('fraud')}}</h3>
                @endif

                @if (session('existonupdateanddelete'))
                    <h3 class="text-danger">{{@session('existonupdateanddelete')}}</h3>
                @endif

                @if ($period->user_id == auth()->user()->id || $period->teacherAlreadyJoinedOrNot(auth()->user()))

                <button class="float-right btn btn-warning" data-toggle="modal" data-target="#exampleModal">Edit</button>
                @endif
                
                @if ($period->user_id == auth()->user()->id)
                <form class="float-right mr-2" action="{{route('delete.period', $period)}}" method="POST" onsubmit="SureToDelete(event)"
                class="d-flex justify-content-around align-items-center my-2"> 
                    @csrf
                    @method('DELETE')
                        
                    <input type="submit" class="btn btn-danger" value="Delete" />  
                </form>
                @endif

                </div>
                <div class="card-body">
                    @if (session('notRelated'))
                        <h4 class="text-danger">{{@session('notRelated')}}</h4>
                    @endif
                    Owner : {{$period->periodforuser->name}}
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Teachers</div>
                <div class="card-body">

                    @if ($teachers->count())
                        @foreach ($teachers as $teacher)

                        @if ($period->user_id == auth()->user()->id)
                            <form  onsubmit="SureToDelete(event)" action="{{route('remove.teacher.period', $teacher)}}" method="POST" class="d-flex justify-content-between align-items-center">
                                @csrf
                                @method('DELETE')
                                <div class="form-group">
                                    <a href="{{route('show.teacher.student.details', $teacher->teacher)}}" class="text-dark">{{$teacher->teacher->name}}</a><br>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-danger">Remove</button>
                                </div>
                            </form>
                        @else
                        <a href="{{route('show.teacher.student.details', $teacher->teacher)}}" class="text-dark">{{$teacher->teacher->name}}</a><br>
                        @endif
                        @endforeach
                    @else
                    <h3 class="text-dark">Currently no teacher teaching here</h3>
                    @endif
                  
                </div>
            </div>
        </div>
    </div> 


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Students</div>
                <div class="card-body">
                    @if ($students->count())
                    @foreach ($students as $student)

                    @if ($period->user_id == auth()->user()->id || $period->teacherAlreadyJoinedOrNot(auth()->user())) 

                    <form  onsubmit="SureToDelete(event)" action="{{route('remove.student.period', $student)}}" method="POST" class="d-flex justify-content-between align-items-center">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <a href="{{route('show.teacher.student.details', $student->student)}}" class="text-dark">{{$student->student->name}}</a><br>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-danger">Remove</button>
                        </div>
                    </form>
                @else
                <a href="{{route('show.teacher.student.details', $student->student)}}" class="text-dark">{{$student->student->name}}</a><br>
                @endif
                   
                   
                    @endforeach
                @else
                <h3 class="text-dark">Currently no student learning here</h3>
                @endif
                </div>
              
            </div>
        </div>
    </div>
</div> 
@endsection
