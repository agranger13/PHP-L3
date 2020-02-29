<?php

namespace App\Controller;

use App\Entity\Consultation;
use App\Entity\Medecin;
use App\Entity\Patient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{
    /**
     * @Route("/patient", name="patient")
     */
    public function index()
    {
        $patient = new Patient();
        $consulation = new Consultation();
        $medecin = new Medecin();

        $patient->setNumSS('13366599533212');
        $patient->setNom('Durand');
        $patient->setPrenom('Alex');
        $maDate = new \DateTime("1968-07-18");
        $patient->setDateNaissance($maDate);
        $patient->setSexe('M');

        $consulation->setDateHeure(new \DateTime("12:05:00"));

        $medecin->setMatricule("2165451-1");
        $medecin->setNom("Dupont");

        //$medecin->addConsultation($consulation);
        //$patient->addConsultation($consulation);

        $doctrine = $this->getDoctrine();
        $entityManager = $doctrine->getManager();
        $entityManager->persist($patient);
        //$entityManager->persist($medecin);
        $entityManager->flush();

        return $this->render('patient/index.html.twig', [
            'controller_name' => 'PatientController',
        ]);
    }

    /**
     * @Route("/patient/list", name="list")
     */
    public function list(){

        $repository = $this 
            ->getDoctrine()
            ->getManager()
            ->getRepository(Patient::class);

        return $this->render('patient/list.html.twig', [
            'controller_name' => 'PatientController',
            'patients_list' => $repository->findAll(),
        ]);
    }
}
