<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/users', name: 'user_index')]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $repository = $doctrine->getManager()->getRepository(User::class);

        return $this->json([
            'users' => $repository->findAll(),
        ]);
    }

    #[Route('/user', name: 'user_show')]
    public function show(ManagerRegistry $doctrine, Request $request): Response
    {
        $user = new User;
        $user->setName($request->request->get('name'));
        $user->setName($request->request->get('email'));
        $user->setName($request->request->get('password'));

        $entity = $doctrine->getManager();
        $entity->persist($user);
        $entity->flush();

        return $this->json([
            'message' => 'Usuário criado'
        ]);

    }
}
