<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="base")
     */
    public function base()
    {
        return $this->render('base.html.twig');

    }

    /**
     * @Route("/acceuil", name="main_acceuil")
     */
    public function acceuil()
    {
        return $this->render('main/acceuil.html.twig');

    }
    /**
     * @Route("/monCompte", name="main_monCompte")
     */
    public function monCompte()
    {
        return $this->render('main/monCompte.html.twig');

    }



}