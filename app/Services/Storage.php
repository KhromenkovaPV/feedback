<?php

namespace App\Services;

class Storage
{
    public const DB_STORAGE = 'db';

    public function getStorage(): StoreInterface
    {
        $storageConfig = config('app.storage_type');
        return match ($storageConfig) {
            self::DB_STORAGE => new DBStorage(),
            default => new FileStorage(),
        };
    }
}
