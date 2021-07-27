<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\User;


use App\Models\StudentInPeriod;

use App\Models\TeacherInPeriod;



class Period extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];



    public function periodforuser(){
        return $this->belongsTo(User::class, 'user_id');
    }




    public function studentsperiods()
    {
        return $this->hasMany(StudentInPeriod::class);
    }



    public function studentAlreadyJoinedOrNot(User $user)
    {
        return $this->studentsperiods->contains('user_id', $user->id);
    }



    
    public function teachersperiods()
    {
        return $this->hasMany(TeacherInPeriod::class);
    }


    
    public function teacherAlreadyJoinedOrNot(User $user)
    {
        return $this->teachersperiods->contains('user_id', $user->id);
    }






}
