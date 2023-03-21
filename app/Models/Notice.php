<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $table = 'notices';
    protected $primaryKey = 'notice_id';
    public $timestamps = false;
    protected $fillable = ['notice_title', 'notice_content', 'file', 'origin_file', 'created_at', 'updated_at'];
}
