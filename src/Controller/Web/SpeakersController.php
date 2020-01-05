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
    public function speakers(PersonRepository $personRepository): Response
    {
        $speakers = $personRepository->findAll();

        return $this->render('speakers.html.twig', [
            'page' => 'speakers',
            'speakers' => $speakers,
        ]);
    }

    /**
     * @Route("/speakers/{slug}", name="speaker")
     */
    public function speaker(string $slug, PersonRepository $personRepository): Response
    {
        $speaker = $personRepository->findBySlug($slug);
        NotFoundRedirector::assertFound($speaker);

        return $this->render('speaker.html.twig', [
            'page' => 'speaker',
            'speaker' => $speaker,
        ]);
    }
}
