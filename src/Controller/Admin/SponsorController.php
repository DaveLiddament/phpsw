<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Sponsor;
use App\Form\SponsorDto;
use App\Form\SponsorDtoType;
use App\Repository\SponsorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/sponsors")
 */
class SponsorController extends AbstractController
{
    /**
     * @Route("", name="sponsorList")
     */
    public function home(SponsorRepository $sponsorRepository): Response
    {
        return $this->render('admin/sponsorList.html.twig', [
            'sponsors' => $sponsorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="sponsorCreate")
     */
    public function create(SponsorRepository $sponsorRepository, Request $request): Response
    {
        $sponsorDto = SponsorDto::newInstance();

        return $this->processSponsorForm($sponsorRepository, $request, $sponsorDto, true);
    }

    /**
     * @Route("/{sponsor}", name="sponsorRead")
     */
    public function read(Sponsor $sponsor): Response
    {
        return $this->render('admin/sponsor.html.twig', [
            'sponsor' => $sponsor,
        ]);
    }

    /**
     * @Route("/{sponsor}/update", name="sponsorUpdate")
     */
    public function update(SponsorRepository $sponsorRepository, Request $request, Sponsor $sponsor): Response
    {
        $sponsorDto = SponsorDto::newInstanceFromSponsor($sponsor);

        return $this->processSponsorForm($sponsorRepository, $request, $sponsorDto, false);
    }

    /**
     * @Route("/{sponsor}/delete", name="sponsorDelete")
     */
    public function delete(SponsorRepository $sponsorRepository, Request $request, Sponsor $sponsor): Response
    {
        if ($request->isMethod('POST')) {
            if ($sponsor->canDelete()) {
                $sponsorRepository->delete($sponsor);
                $this->addFlash(FlashLevels::SUCCESS, "Sponsor {$sponsor->getName()} has been deleted");
            } else {
                $this->addFlash(FlashLevels::DANGER, "Could not delete sponsor {$sponsor->getName()}");
            }

            return $this->redirectToRoute('sponsorList');
        }

        return $this->render('admin/sponsorDelete.html.twig', [
            'sponsor' => $sponsor,
        ]);
    }

    private function processSponsorForm(
        SponsorRepository $sponsorRepository,
        Request $request,
        SponsorDto $sponsorDto,
        bool $isCreate
    ): Response {
        $form = $this->createForm(SponsorDtoType::class, $sponsorDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sponsor = $sponsorDto->asSponsor();
            $sponsorRepository->persist($sponsor);
            $message = "Sponsor {$sponsor->getName()} ".($isCreate ? 'created' : 'updated');
            $this->addFlash(FlashLevels::SUCCESS, $message);

            return $this->redirectToRoute('sponsorList');
        }

        return $this->render('admin/sponsorForm.html.twig', [
            'isCreate' => $isCreate,
            'form' => $form->createView(),
        ]);
    }
}
