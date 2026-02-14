<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Camiseta;
use App\Repository\CategoriaRepository;
use App\Repository\CamisetaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CategoriaController extends AbstractController
{

    #[Route('/categoria/crear', name: 'crearCotegoria')]
    public function nuevaCategoria(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $categoria = new Categoria();
        $categoria->setNombre($data['nombre']);
        $entityManager->persist($categoria);
        $entityManager->flush();
        return new JsonResponse($categoria->getId());
    }
    #[Route('/categoria/{nombre}', name: 'categoria')]
    public function index(CategoriaRepository $categoriaRepository, string $nombre, CamisetaRepository $camisetaRepository): Response
    {
        $categoria = $categoriaRepository->findOneBy(['nombre' => $nombre]);
        $camisetas = $camisetaRepository->findBy(['categoria' => $categoria->getId()]);
        return $this->render('page/camisetes/camisetes.html.twig', [
            'camisetas' => $camisetas,
        ]);
    }
}
