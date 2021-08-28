<?php

namespace App\Traits;

trait HasDescription
{
    public function getNameAttribute()
    {
        return $this->description->name ?? null;
    }

    public function getDescriptionAttribute()
    {
        return $this->description->description ?? null;
    }
}