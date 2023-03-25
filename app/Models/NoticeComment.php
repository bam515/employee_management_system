<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeComment extends Model
{
    use HasFactory;

    protected $table = 'notice_comments';
    protected $primaryKey = 'notice_comment_id';
    public $timestamps = false;
    protected $fillable = ['notice_id', 'user_id', 'notice_comment', 'created_at', 'updated_at'];
}
