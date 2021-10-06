<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'section_id', 'name', 'phone', 'email', 'password', 'photo', 'address', 'gender'];
}
