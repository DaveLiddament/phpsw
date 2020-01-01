<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Form\VenueDto;
use App\Form\VenueDtoType;
use App\Repository\VenueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/create", name="venueCreate")
     */
    public function create(VenueRepository $venueRepository, Request $request): Response
    {
        $venueDto = VenueDto::newInstance();
        $form = $this->createForm(VenueDtoType::class, $venueDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $venue = $venueDto->asVenue();
            $venueRepository->persist($venue);
            $this->addFlash('info', 'Venue created');

            return $this->redirectToRoute('venueList');
        }

        return $this->render('admin/venueAdd.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
