<?php

namespace App\Managers;

use App\Services\Storage;
use App\Services\StoreInterface;

class FeedbackManager
{
    private StoreInterface $store;

    public function __construct(Storage $storage) {
        $this->store = $storage->getStorage();
    }

    public function saveFeedback(string $name, string $phone, string $message): void
    {
        $this->store->storeFeedback($name, $phone, $message);
    }
}
