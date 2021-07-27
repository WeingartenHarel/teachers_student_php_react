<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Auth;
use Illuminate\Support\Str;


class UserController extends Controller
{
    function index(){                
        return view('users.show');
    }



    function getuser(){
        $users=User::all()->toJson();          
        return $users;
    }



    function create(){
                
        return view('users.create');
    }


    function storeuser(Request $request){  
        $count=User::where('email',$request->email)->count();    
        $token = Str::random(60);

        if($count>0){
            return response()->json([
                "status" => false,
                'msg' => "User already exists"
              ], 202);
        }        
        else{  

        $user=User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
            'api_token' => $token,
            'subject_a'=>$request->subject_a,
            'subject_b'=>$request->subject_b,
            'subject_c'=>$request->subject_c,
            'subject_d'=>$request->subject_d,
        ]);


        //role is by default 0
        //for any reason $user object not returning the role so we returning 0

        if($user){
            return response()->json([
                "status" => true,
                "name" => $user->name,
                "role" => 0,
                'token' => $user->api_token,
                
                
              ], 200);


           
        }
        else{
            return response()->json([
                'status' => false,
                "msg" => "Error"
              ], 201);
        }
    }
    }


    function updateuser(Request $request){        
        $user=User::where('id',$request->id)->update([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
            'subject_a'=>$request->subject_a,
            'subject_b'=>$request->subject_b,
            'subject_c'=>$request->subject_c,
            'subject_d'=>$request->subject_d,
        ]);
        if($user){
            return response()->json([
                "message" => "Success"
              ], 200);
        }
        else{
            return response()->json([
                "message" => "Error"
              ], 201);
        }
    }

    function edituser(Request $request){
        $count=User::where('id',$request->id)->count();
        if($count>0){
            $user=User::find($request->id);
            return $user->toJson();
        }
        else{
            return response()->json([
                "message" => "Error"
              ], 204);
        }
        // return view('users.edit',compact('user'));
    }


    function update(Request $request,$id){
       $user=User::where('id',$id)->update([
           "name"=>$request->name,
           "email"=>$request->email,
           "password"=>$request->password
       ]) ;
       if($user){
           return "true";
       }
        // $user=User::find($id);   
        // $user->name=$request->name;
        // $user->email=$request->email;
        // $user->password=$request->password;
        // $user->save();
    }

    function deleteuser(Request $request){
        $user=User::find($request->id);
        $user->delete();        
            return response()->json([
                "message" => "Success"
              ], 200);
    }
    
    function updateprofile(Request $request){
        $user=User::where('id',auth::user()->id)->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
        if($user){
            if(auth::user()->role=="0"){
                
            return redirect()->route('student.dashboard')->with('message','Profile has been updated');
            }
            else{
                return redirect()->route('admin.dashboard')->with('message','Profile has been updated');
            }
        }
    }
    function changepassword(){

    }

    function updatepassword(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);   
        return redirect()->route('student.dashboard')->with('message','Password has been updated successfully');
    }


    function login(Request $request){

        $user = User::where("email" ,$request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                $user->update([
                    'api_token' => Str::random(60),

                ]);
                
                return response()->json([
                    'status' => true,
                    "token" => $user->api_token,
                    "role" => $user->role,
                    "name" => $user->name,
                ]);
            }
    
        }

        return response()->json([
            'status' => false,
            "dontExist" => 'wrong email and password'
        ]);



    
    
}


function singleUser(Request $request, $token){
    $user = User::where("api_token" ,$token)->first();

    if ($user) {
       return response()->json([
        $user
       ]);
    }

    return response()->json([
        'msg' => 'User doesnot exist'
    ]);
}



function updateSingleUser(Request $request){
    $user = User::where("api_token" ,$request->token)->first();

    if ($user) {

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);

        return response()->json([
        'update' => true
        ]);
     }


     return response()->json([
        'update' => false
        ]);
 


}



function updateUserpassword(Request $request){
    $req = $request->validate([
        'current_password' => ['required', new MatchOldPassword],
        'new_password' => ['required'],
        'new_confirm_password' => ['same:new_password'],
    ]);


    $user = User::where("api_token" ,$request->token)->first();

    
        if ($user) {
            $user->update([
                'password'=> Hash::make($request->new_password)
            ]);

            return response()->json([
                'passUpdated' => true
            ]);
    }

        return response()->json([
            'passUpdated' => false
        ]);
    }   
    




}