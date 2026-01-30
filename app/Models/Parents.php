<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parents extends Model
{
    use SoftDeletes;

    protected $table = 'parents';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country',
        'birth_date',
        'state',
        'city',
        'residential_proof',
        'profile_image',
        'education',
        'occupation'
    ];

    public function childrens(){
        return $this->hasMany(ParentsChildrens::class, 'parent_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name; 
    }
}