<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'subject',
        'description',
        'status'
    ];
    protected $table = "complaints";
}
