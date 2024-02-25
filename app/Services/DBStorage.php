<?php

namespace App\Services;

use App\Models\Feedback;

class DBStorage implements StoreInterface
{
    public function storeFeedback(string $name, string $phone, string $message): void
    {
        $feedback = new Feedback();
        $feedback->name = $name;
        $feedback->phone = $phone;
        $feedback->message = $message;
        $feedback->save();
    }
}
