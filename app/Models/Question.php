<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubmitQuiz;

class Question extends Model
{
    use HasFactory;
     protected $table= 'qustions';
     protected $guarded = [];

    
}
