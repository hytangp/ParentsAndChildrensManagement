<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentsChildrens extends Model
{
    use SoftDeletes;

    protected $table = 'parents_childrens';

    protected $fillable = ['parent_id', 'children_id'];

    public function parent(){
        return $this->belongsTo(Parents::class, 'parent_id');
    }

    public function children(){
        return $this->belongsTo(Childrens::class, 'children_id');
    }
}