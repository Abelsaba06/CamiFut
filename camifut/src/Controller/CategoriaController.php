<?php

namespace App\Controller;

use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CategoriaController extends AbstractController
{
    #[Route('/categoria', name: 'categoria')]
    public function index(): Response
    {
        return $this->render('page/camisetes/camisetes.html.twig', [
            'controller_name' => 'CategoriaController',
        ]);
    }
    #[Route('/categoria/crear', name: 'crearCotegoria')]
    public function nuevaCategoria(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $categoria=new Categoria();
        $categoria->setNombre($data['nombre']);
        $entityManager->flush();
        return new JsonResponse($categoria->getId());
    }
}
