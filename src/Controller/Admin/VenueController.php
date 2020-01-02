<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Venue;
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
class VenueController extends AbstractController
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

        return $this->processVenueForm($venueRepository, $request, $venueDto, true);
    }

    /**
     * @Route("/{venue}", name="venueUpdate")
     */
    public function update(VenueRepository $venueRepository, Request $request, Venue $venue): Response
    {
        $venueDto = VenueDto::newInstanceFromVenue($venue);

        return $this->processVenueForm($venueRepository, $request, $venueDto, false);
    }

    private function processVenueForm(
        VenueRepository $venueRepository,
        Request $request,
        VenueDto $venueDto,
        bool $isCreate
    ): Response {
        $form = $this->createForm(VenueDtoType::class, $venueDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $venue = $venueDto->asVenue();
            $venueRepository->persist($venue);
            $message = "Venue {$venue->getName()} ".($isCreate ? 'created' : 'updated');
            $this->addFlash(FlashLevels::SUCCESS, $message);

            return $this->redirectToRoute('venueList');
        }

        return $this->render('admin/venueForm.html.twig', [
            'isCreate' => $isCreate,
            'form' => $form->createView(),
        ]);
    }
}
