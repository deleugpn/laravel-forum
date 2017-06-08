<?php

namespace AndreasElia\Forum\Models;

use AndreasElia\Forum\Models\Discussion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }
}
