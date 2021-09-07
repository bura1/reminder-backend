<?php

namespace App\Controller;

use App\Entity\Reminder;
use App\Repository\ReminderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReminderController extends AbstractController
{
    /**
     * @Route("/reminders/show")
     */
    public function show(ReminderRepository $reminderRepository)
    {
        $reminders = $reminderRepository->transformAll();
        return new JsonResponse($reminders);
    }

    /**
     * @Route("/reminders/new")
     */
    public function new(EntityManagerInterface $entityManager)
    {
        $reminder = new Reminder();
        $reminder->setText("Tekst remindera 1")
            ->setSlug("tekst-remindera-1")
            ->setCreatedOnDate(new \DateTime());

        $entityManager->persist($reminder);
        $entityManager->flush();

        return new Response(sprintf('Reminder text is ' . $reminder->getText()));
    }
}