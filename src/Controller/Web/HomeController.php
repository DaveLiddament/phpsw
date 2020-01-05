<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Repository\PersonRepository;
use App\Repository\SponsorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(PersonRepository $personRepository, SponsorRepository $sponsorRepository): Response
    {
        return $this->render('home.html.twig', [
            'page' => 'home',
            'organisers' => $personRepository->findOrganisers(),
            'sponsors' => $sponsorRepository->findCurrentSponsors(),
            'friends' => [], // TODO add friends
        ]);
    }
}
