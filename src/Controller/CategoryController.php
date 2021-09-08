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
    protected $statusCode = 200;

    /**
     * @Route("/categories", methods="GET")
     */
    public function categories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->transformAll();
        return new JsonResponse($categories);
    }

    /**
     * @Route("/categories/new/{name}", methods="POST")
     */
    public function new($name, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository)
    {
        $category = new Category();
        $category->setName($name)
            ->setSlug(strtolower($name));

        $entityManager->persist($category);
        $entityManager->flush();

        return $this->respondCreated($categoryRepository->transform($category));
    }

    public function respondCreated($data = [])
    {
        return $this->setStatusCode(201)->respond($data);
    }
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }
    public function respond($data, $headers = [])
    {
        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}