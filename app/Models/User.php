<?php

namespace App\Models;

use App\Enums\Specialization;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'spec',
        'stdsn',
        'group_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'spec' => Specialization::class,
    ];

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search) => $query
            ->where('first_name', 'LIKE', '%' . $search . '%')
            ->orWhere('last_name', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhere('stdsn', 'LIKE', '%' . $search . '%'));
    }
    public function scopeExcept(Builder $query, User $user)
    {
        return $query->where('id', '!=', $user->id);
    }
    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
    public function groupRequests()
    {
        return $this->hasMany(GroupRequest::class, 'id', 'sender_id');
    }
}
