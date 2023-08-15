<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;



    public function majors(){
        return $this->belongsToMany(Major::class);
    }

    public function getActiveStatusAttribute(){
        return $this->is_active ? 'Active' : 'not Active';
    }

    protected $hidden = ['created_at' ,'updated_at'];   // json  ما بيطهروا في ال رسبونس

    protected $appends = ['active_status'];

    // protected $fillable = ['name' , 'is_active' , 'location'];    just for $hospital->create($request->all());
}
