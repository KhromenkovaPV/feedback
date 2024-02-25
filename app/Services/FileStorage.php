<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage as BaseStorage;

class FileStorage implements StoreInterface
{
    public function storeFeedback(string $name, string $phone, string $message): void
    {
        $fileName = Carbon::now()->format('Y-m-d') . '.txt';
        BaseStorage::disk('public')
            ->append($fileName, json_encode(['name' => $name, 'phone' => $phone, 'message' => $message]));
    }
}
