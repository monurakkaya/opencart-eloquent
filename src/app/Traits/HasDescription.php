<?php

namespace App\Traits;

trait HasDescription
{
    public function getNameAttribute()
    {
        return $this->description->name ?? '';
    }
}