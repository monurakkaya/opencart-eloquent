<?php

namespace App\Models\Catalog\Option\Value;

use App\Models\Catalog\Option\Option;
use App\Models\Model;
use App\Support\Helper;

class Value extends Model
{
    //trait
    protected $table = DB_PREFIX.'option_value';

    protected $primaryKey = 'option_value_id';

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id', 'option_id');
    }

    public function description()
    {
        return $this->hasOne(Description::class, 'option_id')
            ->where('language_id', Helper::session('config_language_id', 1));
    }

    public function descriptions()
    {
        return $this->hasMany(Description::class, 'option_id');
    }

    //ocmod
}