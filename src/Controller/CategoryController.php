<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
}