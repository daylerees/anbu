<?php

namespace Anbu\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    /**
     * Database table name.
     *
     * @var string
     */
    public $table = 'anbu';

    /**
     * Retrieve the unserialized data.
     *
     * @return array
     */
    public function getData()
    {
        // Get the unserialized storage.
        return unserialize(gzdecode($this->storage));
    }
}
