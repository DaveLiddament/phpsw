<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Controller\NotFoundRedirector;
use App\Repository\TalkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TalksController extends AbstractController
{
    /**
     * @Route("/talks", name="talks")
     */
    public function talks(TalkRepository $talkRepository): Response
    {
        $talks = $talkRepository->findShowCase();

        return $this->render('talks.html.twig', [
            'page' => 'talks',
            'talks' => $talks,
        ]);
    }

    /**
     * @Route("/talks/{slug}", name="talk")
     */
    public function talk(TalkRepository $talkRepository, string $slug): Response
    {
        $talk = $talkRepository->findBySlug($slug);
        NotFoundRedirector::assertFound($talk);

        return $this->render('talk.html.twig', [
            'page' => 'talks',
            'talk' => $talk,
        ]);
    }
}
