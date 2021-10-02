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
     * @Route("/reminders/{category_id}")
     */
    public function reminders(ReminderRepository $reminderRepository, $category_id)
    {
        /*$remindersById = $reminderRepository->findOneBy(
            ["id" => 1]
        );*/
        $remindersById = $reminderRepository->findAll();
        return new JsonResponse($remindersById);
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