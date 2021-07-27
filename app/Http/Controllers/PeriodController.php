<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Period;

use App\Models\StudentInPeriod;

use App\Models\TeacherInPeriod;


class PeriodController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    // public function storePeriod(Request $request){

    //     $request->validate([
    //         'name' => 'required'
    //     ]);


    //     $user = User::where('api_token', $request->token)->first();

        

    //     if (!$user) {
    //         return response()->json([
    //             'status' => false,
    //             'msg' => "User doesn't exist",
    //         ], 404);

    //     }

        
       



        
    //     if ($user->role == 0) {
    //         return response()->json([
    //             'status' => false,
    //             'msg' => "Sorry You are not a teacher",
    //         ]);

    //     }


    //     $period = Period::where('user_id', $user->id)->exists();


    //     if ($period) {
    //         return response()->json([
    //             'status' => false,
    //             'msg' => "Sorry You already have a period",
    //         ]);
    //     }


    //     $user->period()->create([
    //         'name' => $request->name,
    //     ]);



    //      return response()->json([
    //         'status' => true,
    //         'msg' => $request->name." created",
    //      ], 201);
    // }



    public function store(Request $request){

        $request->validate([
            'name' => 'required'
        ]);

        $user = auth()->user();

        
        if ($user->role == 0) {
            return back();
        }


        $periodExist = Period::where('name', $request->name)->exists();

        $period = Period::where('user_id', $user->id)->exists();


        if ($periodExist) {
            return back()->with('exist', 'This name is taken chose something else');
        }


        
        if ($period) {
            return back()->with('youOwn', 'You already own a period');
        }


        $user->period()->create([
            'name' => $request->name,
        ]);


        return back();
    }

//182124163

//b4xixhgk


    
    // public function myPeriod($token){


    //     $user = User::where('api_token', $token)->first();

        

    //     if (!$user) {
    //         return response()->json([
    //             'status' => false,
    //             'msg' => "User doesn't exist",
    //         ], 404);

    //     }



    //     if ($user->period != null) {
    //         return response()->json([
    //             'status' => true,
    //             'periodDetails' => $user->period,
    //          ]);

            
    //     }

    
    //     return response()->json([
    //         'status' => false,
    //         'periodDetails' => 'You dont have a period right now'
    //      ]);



        
    // }


    public function showPeriodPage(Request $request){


        // $user = User::where('id', $token)->first();


       $datastest = auth()->user()->period;

        $datas;

       

        // if (!$user) {
        //     return response()->json([
        //         'status' => false,
        //         'msg' => "User doesn't exist",
        //     ], 404);

        // }


        if ($datastest != null) {
           $datas = $datastest;
        }else{
            $datas = null;
        }


        $ITeachIn = TeacherInPeriod::where('user_id', auth()->user()->id)->paginate(20);

        return view('admin.period', [
            'datas' => $datas,
            'IteachIn' => $ITeachIn,
        ]);
            
        }

    
        // return response()->json([
        //     'status' => false,
        //     'periodDetails' => 'You dont have a period right now'
        //  ]);



        
        public function updatePeriod(Request $request, Period $period){
            $request->validate([
                'periodnewname' => 'required',
            ]);

            $scanNewPeriod = Period::where('name', $request->periodnewname)->exists();


         

            if ($scanNewPeriod) {
               return back()->with('existonupdateanddelete', 'This name is taken chose something else');
            }


            if ($period->user_id == auth()->user()->id || $period->teacherAlreadyJoinedOrNot(auth()->user())) {

                $period->update([
                    'name' => $request->periodnewname,
                ]);

                return back();
             }
 
         


            return back()->with('notRelated', 'You are not a teacher here');
        }

            
        public function deletePeriod(Period $period){


            $canYouDeleteIt = $period->user_id == auth()->user()->id;

            if (!$canYouDeleteIt) {
               return back()->with('existonupdateanddelete', 'You dont owen that');
            }

            $period->delete();

            return redirect()->route('admin.period');


        }



        public function allPeriods(){

            $periods = Period::latest()->paginate(20);

            return view('allperiods', [
                'periods' => $periods,
            ]);
        }
    


        

        public function joinInPeriodsForBoth(Period $period){

            $user = auth()->user();

            if ($user->role == 0) {

            if (!$period->studentAlreadyJoinedOrNot($user)) {
                $period->studentsperiods()->create([
                    'user_id' => $user->id,
                ]);


                return back();
            }


            $period->studentsperiods()->where('user_id', $user->id)->delete();
               
                

                return back();
            }


            if ($period->user_id == $user->id) {
               return back()->with('youCant', 'You cant join in your period you are already in it');
            }

            
            if (!$period->teacherAlreadyJoinedOrNot($user)) {
                $period->teachersperiods()->create([
                    'user_id' => $user->id,
                ]);

                return back();
            }


            $period->teachersperiods()->where('user_id', $user->id)->delete();
            return back();



           
        }




        public function studentPeriodOwn(){

            $user = auth()->user();

            $datas = StudentInPeriod::where('user_id', $user->id)->paginate(20);

           // dd($datas);
            return view('student.periods',[
                'datas' => $datas,
            ]);
        }



        public function showPeriodDetails(Period $period){

            $teachers  = $period->teachersperiods;

            $students  = $period->studentsperiods;


           
           // $ownerName = User::where('id', $period->user_id)->first();


          
            return view('perioddetails',[
                'period' => $period,
                // 'owner' => $ownerName,
                'teachers' => $teachers,
                'students' => $students,
            ]);

        }



        public function removeTeacherFromMyPeriod(TeacherInPeriod $period){
           // dd($period);

           if ($period->period->user_id == auth()->user()->id) {
            $period->delete();
            return back();
        }

        return back()->with('fraud', 'You cant do that');
        }


        public function removeStudentFromMyPeriod(StudentInPeriod $period){
            //dd($period);

            if ($period->period->user_id == auth()->user()->id || $period->period->teacherAlreadyJoinedOrNot(auth()->user())) {
                $period->delete();
                return back();
            }

            return back()->with('fraud', 'You cant do that');
 
            //dd("no");
        }
    




        

        public function showTeacher(){

            $teachers = User::where('role', 1)->paginate(20);


            return view('teachertable', [
                'teachers' =>  $teachers,
            ]);
          
        }
    





        public function showStudent(){

            $students = User::where('role', 0)->paginate(20);

            return view('studenttable', [
                'students' =>  $students
            ]);
          
        }



        public function showTeacherAndStudentDetails(User $user){

           
            return view('teacherstudentdetails', [
                'user' => $user,
            ]);
        }
    





}
