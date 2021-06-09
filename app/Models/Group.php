<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Dept;


class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'dept_id',
        'status'
    ];
    public function dept()
    {
        return $this->belongsTo(Dept::class,'dept_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
    public function users()
    {
        return $this->hasMany(User::class,'group_id');
    }
}

