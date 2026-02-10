<?php

namespace App\Controller;

use App\Repository\CategoriaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(CategoriaRepository $categoriaRepository): Response
    {
        $categorias=$categoriaRepository->findAll();
        return $this->render('/page/admin/admin.html.twig', ['categorias'=>$categorias]);
    }
}
