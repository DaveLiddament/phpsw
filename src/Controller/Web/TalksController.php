<?php

declare(strict_types=1);

namespace App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TalksController extends AbstractController
{
    /**
     * @Route("/talks", name="talks")
     */
    public function sponsors(): Response
    {
        return $this->render('talks.html.twig', [
            'page' => 'talks',
            'talks' => [],
        ]);
    }
}
