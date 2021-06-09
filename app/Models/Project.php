<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dept;
use App\Models\User;
use App\Models\Group;

class Project extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'description',
        'taken',
        'supervisor_id',
        'dept_id'
    ];
    public function dept()
    {
        return $this->belongsTo(Dept::class,'dept_id');
    }
    public function supervisor()
    {
        return $this->belongsTo(User::class,'supervisor_id','id');
    }
    public function group()
    {
        return $this->hasOne(Group::class);
    }
    public function users()
    {
        return $this->hasManyThrough(User::class,Group::class);
    }
}
