<?php

namespace Anbu\Repositories;

use Anbu\Models\Storage;

interface Repository
{
    /**
     * Get a storage model.
     *
     * @param  string $key
     * @return Anbu\Models\Storage
     */
    public function get($key = null);

    /**
     * Store a storage model.
     *
     * @param  Storage $storage
     * @return void
     */
    public function put(Storage $storage);

    /**
     * Get an array of all storage models.
     *
     * @return array
     */
    public function all();

    /**
     * Clear all storage records.
     *
     * @return void
     */
    public function clear();
}
