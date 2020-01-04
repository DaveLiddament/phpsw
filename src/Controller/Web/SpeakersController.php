<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Controller\NotFoundRedirector;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpeakersController extends AbstractController
{
    /**
     * @Route("/speakers", name="speakers")
     */
    public function speakers(): Response
    {
        return $this->render('speakers.html.twig', [
            'page' => 'speakers',
            'speakers' => [],
        ]);
    }

    /**
     * @Route("/speakers/{speakerSlug}", name="speaker")
     */
    public function speaker(string $speakerSlug, PersonRepository $personRepository): Response
    {
        $speaker = $personRepository->findBySlug($speakerSlug);
        NotFoundRedirector::assertFound($speaker);
        return $this->render('speaker.html.twig', [
            'page' => 'speaker',
            'speaker' => $speaker,
        ]);
    }

}
