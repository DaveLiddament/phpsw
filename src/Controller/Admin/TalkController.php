<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Entity\Talk;
use App\Form\TalkDto;
use App\Form\TalkDtoType;
use App\Repository\TalkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/talks")
 */
class TalkController extends AbstractController
{
    /**
     * @Route("/create/{event}", name="talkCreate")
     */
    public function create(TalkRepository $talkRepository, Request $request, Event $event): Response
    {
        $talkDto = TalkDto::newInstance($event);

        return $this->processTalkForm($talkRepository, $request, $talkDto, true);
    }

    /**
     * @Route("/{talk}", name="talkRead")
     */
    public function read(Talk $talk): Response
    {
        return $this->render('admin/talk.html.twig', [
            'talk' => $talk,
        ]);
    }

    /**
     * @Route("/{talk}/update", name="talkUpdate")
     */
    public function update(TalkRepository $talkRepository, Request $request, Talk $talk): Response
    {
        $talkDto = TalkDto::newInstanceFromTalk($talk);

        return $this->processTalkForm($talkRepository, $request, $talkDto, false);
    }

    /**
     * @Route("/{talk}/delete", name="talkDelete")
     */
    public function delete(TalkRepository $talkRepository, Request $request, Talk $talk): Response
    {
        if ($request->isMethod('POST')) {
            $talkRepository->delete($talk);
            $this->addFlash(FlashLevels::SUCCESS, "Talk {$talk->getTitle()} has been deleted");

            return $this->redirectToRoute('eventRead', [
                'event' => $talk->getEvent()->getId(),
            ]);
        }

        return $this->render('admin/talkDelete.html.twig', [
            'talk' => $talk,
        ]);
    }

    private function processTalkForm(
        TalkRepository $talkRepository,
        Request $request,
        TalkDto $talkDto,
        bool $isCreate
    ): Response {
        $form = $this->createForm(TalkDtoType::class, $talkDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $talk = $talkDto->asTalk();
            $talkRepository->persist($talk);
            $message = "Talk {$talk->getTitle()} ".($isCreate ? 'created' : 'updated');
            $this->addFlash(FlashLevels::SUCCESS, $message);

            return $this->redirectToRoute('eventRead', [
                'event' => $talk->getEvent()->getId(),
            ]);
        }

        return $this->render('admin/talkForm.html.twig', [
            'isCreate' => $isCreate,
            'event' => $talkDto->getEvent(),
            'form' => $form->createView(),
        ]);
    }
}
