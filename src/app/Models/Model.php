<?php


namespace App\Models;


class Model extends \Illuminate\Database\Eloquent\Model
{
    //trait
    const CREATED_AT = 'date_added';
    const UPDATED_AT = 'date_modified';

    protected $guarded = [];

    //ocmod
}