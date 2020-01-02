<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Form\EventDto;
use App\Form\EventDtoType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/events")
 */
class EventController extends AbstractController
{
    /**
     * @Route("", name="eventList")
     */
    public function home(EventRepository $eventRepository): Response
    {
        return $this->render('admin/eventList.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="eventCreate")
     */
    public function create(EventRepository $eventRepository, Request $request): Response
    {
        $eventDto = EventDto::newInstance();

        return $this->processEventForm($eventRepository, $request, $eventDto, true);
    }

    /**
     * @Route("/{event}", name="eventRead")
     */
    public function read(Event $event): Response
    {
        return $this->render('admin/event.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @Route("/{event}/update", name="eventUpdate")
     */
    public function update(EventRepository $eventRepository, Request $request, Event $event): Response
    {
        $eventDto = EventDto::newInstanceFromEvent($event);

        return $this->processEventForm($eventRepository, $request, $eventDto, false);
    }

    /**
     * @Route("/{event}/delete", name="eventDelete")
     */
    public function delete(EventRepository $eventRepository, Request $request, Event $event): Response
    {
        if ($request->isMethod('POST')) {
            if ($event->canDelete()) {
                $eventRepository->delete($event);
                $this->addFlash(FlashLevels::SUCCESS, "Event {$this->asName($event)} has been deleted");
            } else {
                $this->addFlash(FlashLevels::DANGER, "Could not delete event {$this->asName($event)}");
            }

            return $this->redirectToRoute('eventList');
        }

        return $this->render('admin/eventDelete.html.twig', [
            'event' => $event,
            'name' => $this->asName($event),
        ]);
    }

    private function processEventForm(
        EventRepository $eventRepository,
        Request $request,
        EventDto $eventDto,
        bool $isCreate
    ): Response {
        $form = $this->createForm(EventDtoType::class, $eventDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = $eventDto->asEvent();
            $eventRepository->persist($event);
            $message = "Event {$this->asName($event)} ".($isCreate ? 'created' : 'updated');
            $this->addFlash(FlashLevels::SUCCESS, $message);

            return $this->redirectToRoute('eventList');
        }

        return $this->render('admin/eventForm.html.twig', [
            'isCreate' => $isCreate,
            'form' => $form->createView(),
        ]);
    }

    private function asName(Event $event): string
    {
        return sprintf('%s %s', $event->getDate()->format('d M Y'), $event->getTitle());
    }
}
