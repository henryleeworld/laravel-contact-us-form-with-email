<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $fillable = ['name', 'email', 'phone', 'subject', 'note'];
}
