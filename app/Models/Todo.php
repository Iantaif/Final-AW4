<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\TodosFactory;


class Todo extends Model
{
    use HasFactory;


    protected $fillable =['title','description','is_completed'];

}
