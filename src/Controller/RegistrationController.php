<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly ValidatorInterface $validator,
    ){}

    #[Route('registration', name: 'app_registration')]
    public function index(Request $request): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);


        $user = new User();
        $user->setEmail($requestBody['email']);

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $requestBody['password'],
        );

        $user->setPassword($hashedPassword);

        $errors = $this->validator->validate($user);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return new JsonResponse(['errors' => $errorsString]);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->json(['message' => 'User created successfully'], Response::HTTP_CREATED);
    }
}
