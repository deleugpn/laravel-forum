<?php

namespace Bitporch\Tests\Stubs\Models;

use Bitporch\Forum\Contracts\User as UserContract;
use Bitporch\Forum\Relationships\HasManyDiscussions;
use Bitporch\Forum\Relationships\HasManyPosts;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements UserContract
{
    use Notifiable, HasManyDiscussions, HasManyPosts;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
