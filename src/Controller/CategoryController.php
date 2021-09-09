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
        $slug = str_replace(' ', '_', strtolower($name));
        $category->setName(substr($name, 0, 250))
            ->setSlug(substr($slug, 0, 250));

        $entityManager->persist($category);
        $entityManager->flush();

        return $this->respondCreated($categoryRepository->transform($category));
    }

    /**
     * @Route("/categories/delete/{id}", methods="DELETE")
     */
    public function delete($id, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->findOneBy(['id' => $id]);

        $entityManager->remove($category);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Category deleted'], Response::HTTP_NO_CONTENT);
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