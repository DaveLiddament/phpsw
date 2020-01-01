<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
