<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


use App\Models\Period;


class StudentInPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];


    protected $with = [
        'student',
        'period'
    ];


    public function student(){
        return $this->belongsTo(User::class, 'user_id');
    }


    // public function user(){
    //     return $this->belongsTo(User::class);
    // }



    public function period(){
        return $this->belongsTo(Period::class, 'period_id');
    }

}
