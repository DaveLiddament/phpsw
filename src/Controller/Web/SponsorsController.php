<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Entity\Sponsor;
use App\Repository\SponsorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SponsorsController extends AbstractController
{
    /**
     * @Route("/sponsors", name="sponsors")
     */
    public function sponsors(SponsorRepository $sponsorRepository): Response
    {
        return $this->render('sponsors.html.twig', [
            'page' => 'sponsors',
            'fullSponsors' => $sponsorRepository->findCurrentSponsorsOfType(Sponsor::FULL),
            'venueSponsors' => $sponsorRepository->findCurrentSponsorsOfType(Sponsor::VENUE),
        ]);
    }
}
