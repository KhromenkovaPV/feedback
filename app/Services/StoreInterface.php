<?php

namespace App\Services;

interface StoreInterface
{
    public function storeFeedback(string $name, string $phone, string $message): void;
}
