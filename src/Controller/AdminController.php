<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Repository\ParticipantRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(): Response
    {
        if ($this->isGranted('ROLE_ADMIN'))
        {
            return $this->render('admin/pageAdmin.html.twig', [
                'controller_name' => 'AdminController',
            ]);
        }
    }

    /**
     * @Route("/listeParticipant", name="participant")
     */
    public function listeParticipant(ParticipantRepository $participantRepository): Response
    {
        $participants = $participantRepository->findAll();


            return $this->render('participant/listeParticipants.html.twig', [
                "participants" => $participants
            ]);

    }
}
