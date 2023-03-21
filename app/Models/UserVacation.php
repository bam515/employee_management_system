<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVacation extends Model
{
    use HasFactory;

    protected $table = 'user_vacations';
    protected $primaryKey = 'user_vacation_id';
    public $timestamps = false;
    protected $fillable = ['user_id', 'start_date', 'end_date'];
}
