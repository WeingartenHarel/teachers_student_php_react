@extends('layouts.app')
@section('content')
<div class="container">









   <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if ($datas == null)
                    <form action="{{route('create.period')}}" method="POST">
                        @csrf

                        @error('name')
                         

                          <div class="form-group text-danger">
                            <label>{{$message}}</label>
                        </div>     
                        @enderror


                        @if (session('exist'))
                            
                            <div class="form-group text-danger">
                                <label>{{@session('exist')}}</label>
                            </div>   
                        @endif

                        
                        @if (session('youOwn'))
                            
                            <div class="form-group text-danger">
                                <label>{{@session('youOwn')}}</label>
                            </div>   
                        @endif

                        <div class="form-group">
                            <label for="">Create a period</label>
                            <input type="text" class="form-control"
                             name="name" />
                        </div>            
                        <input type="submit" class="btn btn-primary" value="Create"/>                   
                    </form>
                    @else
                    <h3>You have a period called : {{$datas->name}}</h3>
                    @endif
                
                </div>
            </div>
        </div>
    </div>
    




{{--     
      <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                <form>
                        <div class="form-group">
                            <label for="">Create a period</label>
                            <input type="text" class="form-control"
                             name="name" />
                        </div>            
                        <input type="submit" class="btn btn-primary" value="Edit"/>                   
                    </form>
                </div>
            </div>
        </div>
    </div> 
   --}}

   
   @if ($datas != null)
       
   <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Your period</div>
            <div class="card-body">
          
                

                
                @if (session('existonupdateanddelete'))
                            
                <div class="form-group text-danger">
                    <label>{{@session('existonupdateanddelete')}}</label>
                </div>   
            @endif

            <div class="d-flex justify-content-around align-items-center my-2">
            <div class="form-group">

            {{$datas->name}}
                    </div>            
                    <input type="submit" class="btn btn-primary" value="Edit"  data-toggle="modal" data-target="#exampleModal"/>                   
                </div>


        
                <form action="{{route('delete.period', $datas)}}" method="POST" onsubmit="SureToDelete(event)"
                class="d-flex justify-content-around align-items-center my-2"> 
                    @csrf
                    @method('DELETE')
                        <div class="form-group">
                            Delete at yuor own risk
                                    </div> 
                        
                        <input type="submit" class="btn btn-danger" value="Delete" />  

                                
                                             
                        </form>


              
          

            </div>
        </div>
    </div>
</div> 





  <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Check your period</div>
            <div class="card-body d-flex justify-content-start align-items-center">
            
                <div class="my-2"> 
                    
                    <a href="{{route('period.drtails', $datas)}}" class="btn btn-success">Your period info</a>
                                          
                    </div>


            </div>
        </div>
    </div>
</div> 




{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> --}}

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
        <form action="{{route('update.period', $datas)}}" method="POST">
            @csrf
            @method("PUT")
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name of the period</label>
            <input type="text" class="form-control" id="recipient-name" name="periodnewname" value="{{$datas->name}}">
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


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Period that I teach in</div>
                <div class="card-body">
                    @if ($IteachIn->count())
                        @foreach ($IteachIn as $teach)
                        <form action="{{route('join.period', $teach->period)}}" method="POST"
                        class="d-flex justify-content-around align-items-center my-2">
                        @csrf
                            <div class="form-group">
                           <a href="#" class="text-dark">{{$teach->period->name}}</a>
                                    </div>            
                                    <input type="submit" class="btn btn-primary" value="Leave"/>                   
                                </form>
            
            
                        @endforeach

                        {{$IteachIn->links()}}

                        @else
                        <h1>Currently your not teaching in others periods</h1>
                    @endif
            

                </div>
            </div>
        </div>
    </div>
</div>
@endsection