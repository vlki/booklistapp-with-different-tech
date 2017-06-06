<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];

    /**
     * Indicates if the model should be timestamped (created_at & updated_at)
     *
     * @var bool
     */
    public $timestamps = false;

}
