<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\UpdateFormType;
use App\Security\AppAuthentification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class MonCompteController extends AbstractController
{
    /**
     * @Route("/compte", name="mon_compte_details")
     */
    public function details(): Response
    {
        return $this->render('mon_compte/details.html.twig');
    }


    /**
     * @Route("/compte/modifier", name="mon_compte_modifier")
     * @param Request $request
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param UserAuthenticatorInterface $userAuthenticator
     * @param AppAuthentification $authenticator
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function modifier(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppAuthentification $authenticator, EntityManagerInterface $entityManager): Response
    {
        $participant = new Participant();
        $participant->setRoles(['ROLE_USER']);
        $form = $this->createForm(UpdateFormType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $participant->setPassword(
                $userPasswordHasher->hashPassword(
                    $participant,
                    $form->get('password')->getData()
                )
            );
//            $participant->SetId($participant->getId());

            $entityManager->persist($participant);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $participant,
                $authenticator,
                $request
            );
        }

        // do anything else you need here, like send an email
        return $this->render('mon_compte/modifier.html.twig',[
            'updateForm'=> $form -> createView(),
        ]);
    }


}
