<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Period;

class TeacherInPeriod extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
    ];


    protected $with = [
        'teacher',
        'period'
    ];


    
    public function teacher(){
        return $this->belongsTo(User::class, 'user_id');
    }


    
    public function period(){
        return $this->belongsTo(Period::class, 'period_id');
    }


}
