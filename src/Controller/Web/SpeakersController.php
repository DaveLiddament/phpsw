<?php

declare(strict_types=1);

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpeakersController extends AbstractController
{
    /**
     * @Route("/speakers", name="speakers")
     */
    public function sponsors(): Response
    {
        return $this->render('speakers.html.twig', [
            'page' => 'speakers',
            'speakers' => [],
        ]);
    }
}
