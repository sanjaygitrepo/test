<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['e_id','e_name','e_email', 'manager_email','t_mon','t_tue','t_wed','t_thu','t_fri'];
}
