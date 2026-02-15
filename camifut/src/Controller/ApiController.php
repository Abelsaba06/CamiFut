<?php

namespace App\Controller;
use App\Entity\Camiseta;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api')]
class ApiController extends AbstractController
{
    #[Route('/show/{id}', name: 'api-show', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, $id): JsonResponse
    {
        $repository = $doctrine->getRepository(Camiseta::class);
        $camiseta = $repository->find($id);
        if (!$camiseta)
            return new JsonResponse("[]", Response::HTTP_NOT_FOUND);

        $data = [
            "id" => $camiseta->getId(),
            "equipo" => $camiseta->getEquipo(),
            "precio" => $camiseta->getPrecio(),
            "imagen" => $camiseta->getImagen(),
            "temporada" => $camiseta->getTemporada(),

        ];
        return new JsonResponse($data, Response::HTTP_OK);
    }
}
