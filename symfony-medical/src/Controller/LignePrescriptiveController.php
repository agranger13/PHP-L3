<?php

namespace App\Controller;

use App\Entity\LignePrescriptive;
use App\Form\LignePrescriptiveType;
use App\Repository\LignePrescriptiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ligne/prescriptive")
 */
class LignePrescriptiveController extends AbstractController
{
    /**
     * @Route("/", name="ligne_prescriptive_index", methods={"GET"})
     */
    public function index(LignePrescriptiveRepository $lignePrescriptiveRepository): Response
    {
        return $this->render('ligne_prescriptive/index.html.twig', [
            'ligne_prescriptives' => $lignePrescriptiveRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ligne_prescriptive_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lignePrescriptive = new LignePrescriptive();
        $form = $this->createForm(LignePrescriptiveType::class, $lignePrescriptive);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lignePrescriptive);
            $entityManager->flush();

            return $this->redirectToRoute('ligne_prescriptive_index');
        }

        return $this->render('ligne_prescriptive/new.html.twig', [
            'ligne_prescriptive' => $lignePrescriptive,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ligne_prescriptive_show", methods={"GET"})
     */
    public function show(LignePrescriptive $lignePrescriptive): Response
    {
        return $this->render('ligne_prescriptive/show.html.twig', [
            'ligne_prescriptive' => $lignePrescriptive,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ligne_prescriptive_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LignePrescriptive $lignePrescriptive): Response
    {
        $form = $this->createForm(LignePrescriptiveType::class, $lignePrescriptive);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ligne_prescriptive_index');
        }

        return $this->render('ligne_prescriptive/edit.html.twig', [
            'ligne_prescriptive' => $lignePrescriptive,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ligne_prescriptive_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LignePrescriptive $lignePrescriptive): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lignePrescriptive->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lignePrescriptive);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ligne_prescriptive_index');
    }
}
