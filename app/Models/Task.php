<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name', 'status', 'priority', 'project_id'
   ];

   function category(){
    return $this->belongsTo('App\Models\Category','project_id');
}

}
