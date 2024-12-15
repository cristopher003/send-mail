<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MailingList  extends Model
{

    public function users() {
        return $this->belongsToMany(User::class, 'mailing_list_user');
    }
}