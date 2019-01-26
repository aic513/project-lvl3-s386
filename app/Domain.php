<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'page_body',
        'response_code',
        'content_length',
        'main_header',
        'meta_keywords',
        'meta_description'
    ];
}
