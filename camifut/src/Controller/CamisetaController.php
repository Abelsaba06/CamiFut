<?php

namespace App\Controller;

use App\Form\CamisetaFormType;
use App\Repository\CamisetaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\File\UploadedFile;

final class CamisetaController extends AbstractController
{

    #[Route(path: "/crear/camiseta", name: "crearCamiseta")]
    public function crearCamiseta(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CamisetaFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $camiseta = $form->getData();

            // Lógica simplificada de subida de imagen
            /** @var UploadedFile $imagen */
            if ($imagen = $form->get('imagen')->getData()) {
                $nombreArchivo = $imagen->getClientOriginalName();
                // Construir ruta: public/img/<NombreCategoria>/
                $ruta = $this->getParameter('kernel.project_dir') . '/public/img/' . $camiseta->getCategoria()->getNombre();

                // Mover archivo
                $imagen->move($ruta, $nombreArchivo);

                // Guardar nombre en base de datos
                $camiseta->setImagen($nombreArchivo);
            }

            $entityManager->persist($camiseta);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin');
        }
        return $this->render('page/camisetes/creaciocamisetes.html.twig', [
            'controller_name' => 'CamisetaController',
            'camisetaform' => $form->createView()
        ]);
    }
    #[Route(path: '/camisetes', name: 'camisetes')]
    public function camisetes(CamisetaRepository $camisetaRepository): Response
    {
        $camisetes = $camisetaRepository->findAll();
        return $this->render('page/camisetes/camisetes.html.twig', [
            'camisetas' => $camisetes
        ]);
    }
    #[Route('/camiseta/{equipo}/{temporada}', name: 'camiseta', requirements: ['temporada' => '.+'])]
    public function index(string $equipo, string $temporada, CamisetaRepository $camisetaRepository): Response
    {
        $camiseta = $camisetaRepository->findOneBy(['equipo' => $equipo, 'temporada' => $temporada]);
        return $this->render('page/camisetes/detall.html.twig', [
            'camiseta' => $camiseta
        ]);
    }
}