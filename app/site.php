<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class site extends Model
{
    protected $fillable = ['id', 'departement', 'site', 'adresse', 'created_at', 'updated_at'];
}
