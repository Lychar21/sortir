<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MonCompteController extends AbstractController

{

    /**
     * @Route("/monCompte", name="main_monCompte")
     */
    public function monCompte()
    {
        return $this->render('main/monCompte.html');

    }
}