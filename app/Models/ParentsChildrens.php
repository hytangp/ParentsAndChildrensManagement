<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentsChildrens extends Model
{
    use SoftDeletes;

    protected $fillable = ['parent_id', 'children_id'];
}