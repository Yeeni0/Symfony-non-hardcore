<?php

namespace App\Controller;

use App\Entity\Coaster;
use App\Form\CoasterType;
use App\Repository\CoasterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/coaster')]
final class CoasterController extends AbstractController
{
    #[Route(name: 'app_coaster_index', methods: ['GET'])]
    public function index(CoasterRepository $coasterRepository): Response
    {
        return $this->render('coaster/index.html.twig', [
            'coasters' => $coasterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_coaster_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coaster = new Coaster();
        $form = $this->createForm(CoasterType::class, $coaster);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coaster);
            $entityManager->flush();

            return $this->redirectToRoute('app_coaster_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coaster/new.html.twig', [
            'coaster' => $coaster,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coaster_show', methods: ['GET'])]
    public function show(Coaster $coaster): Response
    {
        return $this->render('coaster/show.html.twig', [
            'coaster' => $coaster,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coaster_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Coaster $coaster, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CoasterType::class, $coaster);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_coaster_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coaster/edit.html.twig', [
            'coaster' => $coaster,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coaster_delete', methods: ['POST'])]
    public function delete(Request $request, Coaster $coaster, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coaster->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($coaster);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_coaster_index', [], Response::HTTP_SEE_OTHER);
    }
}
