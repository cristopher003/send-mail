<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog   extends Model
{

    protected $fillable = ['email', 'status', 'error_message'];
}