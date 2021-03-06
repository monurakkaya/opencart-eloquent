<?php


namespace App\Models;


class Model extends \Illuminate\Database\Eloquent\Model
{
    const CREATED_AT = 'date_added';
    const UPDATED_AT = 'date_modified';

    protected $guarded = [];
}