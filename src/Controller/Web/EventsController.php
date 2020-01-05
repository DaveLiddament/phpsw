<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Controller\NotFoundRedirector;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
    /**
     * @Route("/events", name="events")
     */
    public function events(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findAll();

        return $this->render('events.html.twig', [
            'page' => 'events',
            'events' => $events,
        ]);
    }

    /**
     * @Route("/events/{slug}", name="event")
     */
    public function event(EventRepository $eventRepository, string $slug): Response
    {
        // If using old slug then redirect to new one.
        $event = $eventRepository->findByOldSlug($slug);
        if ($event) {
            return $this->redirectToRoute('event', [
                'slug' => $event->getSlug(),
            ]);
        }

        $event = $eventRepository->findBySlug($slug);
        NotFoundRedirector::assertFound($event);

        return $this->render('event.html.twig', [
            'page' => 'events',
            'event' => $event,
        ]);
    }
}
