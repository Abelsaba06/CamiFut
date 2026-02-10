<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CamisetaController extends AbstractController
{
    #[Route(path:"/crear/camiseta", name:"crearCamiseta")]
    public function crearCamiseta(): Response
    {
        return $this->render('page/camisetes/camisetes.html.twig', [
            'controller_name' => 'CamisetaController',
        ]);
    }
    #[Route('/camiseta/{id}', name: 'camiseta')]
    public function index(): Response
    {
        return $this->render('camiseta/index.html.twig', [
            'controller_name' => 'CamisetaController',
        ]);
    }
}
