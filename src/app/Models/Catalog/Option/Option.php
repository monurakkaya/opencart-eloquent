<?php


namespace App\Models\Catalog\Option;


use App\Models\Catalog\Option\Value\Value;
use App\Models\Model;
use App\Support\Helper;

class Option extends Model
{
    //trait

    protected $table = DB_PREFIX.'option';

    protected $primaryKey = 'option_id';

    public function description()
    {
        return $this->hasOne(Description::class, 'option_id')
            ->where('language_id', Helper::session('config_language_id', 1));
    }

    public function descriptions()
    {
        return $this->hasMany(Description::class, 'option_id');
    }

    public function values()
    {
        return $this->hasMany(Value::class, 'option_id');
    }

    //ocmod
    
}