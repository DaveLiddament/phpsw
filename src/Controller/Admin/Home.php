<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class Home extends AbstractController
{
    /**
     * @Route("/admin", name="adminHome")
     */
    public function home(): Response
    {
        return $this->render('admin/home.html.twig', [
        ]);
    }
}
