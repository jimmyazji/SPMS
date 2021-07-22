<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Directory extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'parent_id'
    ];
    public function parent()
    {
        return $this->belongsTo(Directory::class,'parent_id','id');
    }
    public function directories()
    {
        return $this->hasMany(Directory::class,'parent_id');
    }
}
