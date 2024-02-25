<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Managers\FeedbackManager;
use Illuminate\Http\Response;

class FeedbackController extends Controller
{
    public function store(StoreFeedbackRequest $request, FeedbackManager $manager): Response
    {
        $manager->saveFeedback(
            $request->name,
            $request->phone,
            $request->message,
        );

        return response('', Response::HTTP_ACCEPTED);
    }
}
