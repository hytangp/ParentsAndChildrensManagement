<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Childrens extends Model
{
    use SoftDeletes;

    protected $table = 'childrens';
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country',
        'birth_date',
        'state',
        'city',
        'birth_certificate'
    ];

    public function parents(){
        return $this->hasMany(ParentsChildrens::class, 'children_id', 'id');
    }
}