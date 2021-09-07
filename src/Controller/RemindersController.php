<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RemindersController
{
    /**
     * @Route("/")
     */
    public function reminders() {
        return new JsonResponse(["aaa" => "bbb"]);
    }
}