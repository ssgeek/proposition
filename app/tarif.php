<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tarif extends Model
{
    protected $fillable = ['id', 'label', 'tjm', 'created_at', 'updated_at'];
}
