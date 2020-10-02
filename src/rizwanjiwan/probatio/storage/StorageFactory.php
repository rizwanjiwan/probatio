<?php
namespace rizwanjiwan\probatio\storage;

/**
 * Class StorageFactory
 * Decides what AbstractStorage we use
 */

class StorageFactory
{

    /**
     * @return AbstractStorage
     */
    public static function get()
    {
        return new PropelStorage();
    }
}