<?php

declare(strict_types=1);

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticPages extends AbstractController
{
    /**
     * @Route("brand", name="brandAssets")
     */
    public function brandAssets(): Response
    {
        return $this->render('brand.html.twig', [
            'page' => '',
        ]);
    }
}
