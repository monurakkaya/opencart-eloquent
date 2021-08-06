<?php


namespace App\Models;


class Model extends \Illuminate\Database\Eloquent\Model
{
    const CREATED_AT = 'date_added';
    const UPDATED_AT = 'date_modified';

    protected $guarded = [];

    protected function newRelatedInstance2($class)
    {
        $filename = str_replace('\\', '/', $class). '.php';
        $filename = DIR_MODIFICATION . '/' . str_replace('App/', 'app/', $filename);
        if (is_file($filename)) {
            include_once ($filename);
        }
        return tap(new $class, function ($instance) {
            if (! $instance->getConnectionName()) {
                $instance->setConnection($this->connection);
            }
        });
    }
}