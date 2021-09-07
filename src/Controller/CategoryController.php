<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Reminder;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories")
     */
    public function categories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->transformAll();
        return new JsonResponse($categories);
    }

    /**
     * @Route("/categories/new")
     */
    public function new(EntityManagerInterface $entityManager)
    {
        $category = new Category();
        $category->setName("Kategorija 4")
            ->setSlug("kategorija-4");

        $entityManager->persist($category);
        $entityManager->flush();

        return new Response(sprintf('New Category is ' . $category->getName()));
    }
}