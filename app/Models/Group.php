<?php

namespace App\Models;

use App\Enums\GroupState;
use App\Enums\ProjectType;
use App\Enums\Specialization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


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
        'state',
        'spec',
        'project_type'
    ];
    protected $casts = [
        'state' => GroupState::class,
        'spec' => Specialization::class,
        'project_type' => ProjectType::class
    ];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'group_id');
    }
}
