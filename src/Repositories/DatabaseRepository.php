<?php

namespace Anbu\Repositories;

use Anbu\Models\Storage;

class DatabaseRepository implements Repository
{
    /**
     * Get a storage model.
     *
     * @param  string $key
     * @return Anbu\Models\Storage
     */
    public function get($key = null)
    {
        // If no key has been provided.
        if (is_null($key)) {

            // Return the latest storage record.
            return Storage::orderBy('id', 'desc')->firstOrFail();
        }

        // Return a storage record by key.
        return Storage::findOrFail($key);
    }

    /**
     * Store a storage model.
     *
     * @param  Storage $storage
     * @return void
     */
    public function put(Storage $storage)
    {
        // Save the record.
        $storage->save();
    }

    /**
     * Get an array of all storage models.
     *
     * @return array
     */
    public function all()
    {
        // Return a list of storage objects.
        return Storage::orderBy('id', 'desc')->get();
    }

    /**
     * Clear all storage records.
     *
     * @return void
     */
    public function clear()
    {
        // Iterate models.
        Storage::get()->each(function ($model) {

            // Delete model.
            $model->delete();
        });
    }
}
