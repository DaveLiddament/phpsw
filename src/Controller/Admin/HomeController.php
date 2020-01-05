<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Repository\EventRepository;
use App\Repository\PersonRepository;
use App\Repository\SponsorRepository;
use App\Repository\TalkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/admin", name="adminHome")
     */
    public function home(
        EventRepository $eventRepository,
        TalkRepository $talkRepository,
        PersonRepository $personRepository,
        SponsorRepository $sponsorRepository
    ): Response {
        return $this->render('admin/home.html.twig', [
            'latestEvent' => $eventRepository->findLatest(),
            'showCaseTalk' => $talkRepository->findShowCase(),
            'organisers' => $personRepository->findOrganisers(),
            'sponsors' => $sponsorRepository->findCurrentSponsors(),
        ]);
    }
}
