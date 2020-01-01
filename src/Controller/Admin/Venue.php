<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Repository\VenueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/venues")
 */
class Venue extends AbstractController
{
    /**
     * @Route("", name="venueList")
     */
    public function home(VenueRepository $venueRepository): Response
    {
        return $this->render('admin/venueList.html.twig', [
            'venues' => $venueRepository->findAll(),
        ]);
    }
}
