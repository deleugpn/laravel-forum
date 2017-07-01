<?php

namespace Bitporch\Forum\Models;

use Bitporch\Forum\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Model
{
    use HasSlug,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'posts_count',
        'participants_count',
        'locked_at',
        'stickied_at',
    ];

    /**
     * The attributes that should be casted as a Carbon object.
     *
     * @var array
     */
    protected $dates = [
        'locked_at',
        'stickied_at',
        'deleted_at',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the groups associtated with the discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Get the posts that are nested under the discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the first post of the discussion.
     *
     * @return mixed
     */
    public function firstPost()
    {
        return $this->posts()->oldest()->with('user')->first();
    }

    /**
     * Get the user who created the discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('forum.user'));
    }
}
