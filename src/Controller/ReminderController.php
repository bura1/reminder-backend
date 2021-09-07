<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReminderController extends ApiController
{
    /**
     * @Route("/reminders")
     */
    public function reminders()
    {
        return $this->respond(["aaa" => "bbb"]);
    }

    /**
     * @Route("/reminders/new")
     */
    public function new()
    {
        return new Response("new");
    }
}