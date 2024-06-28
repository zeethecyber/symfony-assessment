<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator,
    ) {
    }

    #[Route('/api/products', name: 'product_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $productRepository = $this->entityManager->getRepository(Product::class);
        $products = $productRepository->findAll();

        return $this->json($products, Response::HTTP_OK);
    }

    #[Route('/api/products/{id}', name: 'product_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $productRepository = $this->entityManager->getRepository(Product::class);
        $product = $productRepository->find($id);

        if (!$product) {
            return $this->json(null, Response::HTTP_NOT_FOUND);
        }

        return $this->json($product, Response::HTTP_OK);
    }

    #[Route('/api/products', name: 'product_store', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        $products = $this->serializer->deserialize($request->getContent(), Product::class, 'json');
        $errors = $this->validator->validate($products);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $requestBody = json_decode($request->getContent(), true);

        $product = new Product();
        $product->setName($requestBody['name']);
        $product->setDescription($requestBody['description']);
        $product->setPrice($requestBody['price']);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $this->json($product, Response::HTTP_CREATED);
    }

    #[Route('/api/products/{id}', name: 'product_update', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        $productRepository = $this->entityManager->getRepository(Product::class);
        $product = $productRepository->find($id);
        $product->setName($requestBody['name']);
        $product->setDescription($requestBody['description']);
        $product->setPrice($requestBody['price']);

        $errors = $this->validator->validate($product);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $this->json($product, Response::HTTP_OK);
    }

    #[Route('/api/products/{id}', name: 'product_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $productRepository = $this->entityManager->getRepository(Product::class);
        $products = $productRepository->find($id);

        $this->entityManager->remove($products);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
