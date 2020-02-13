<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Content;
use App\Form\ContentDto;
use App\Form\ContentDtoType;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/content")
 */
class ContentController extends AbstractController
{
    /**
     * @Route("", name="contentList")
     */
    public function home(ContentRepository $contentRepository): Response
    {
        return $this->render('admin/contentList.html.twig', [
            'contents' => $contentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="contentCreate")
     */
    public function create(ContentRepository $contentRepository, Request $request): Response
    {
        $contentDto = ContentDto::newInstance();

        return $this->processContentForm($contentRepository, $request, $contentDto, true);
    }

    /**
     * @Route("/{content}/update", name="contentUpdate")
     */
    public function update(ContentRepository $contentRepository, Request $request, Content $content): Response
    {
        $contentDto = ContentDto::newInstanceFromContent($content);

        return $this->processContentForm($contentRepository, $request, $contentDto, false);
    }

    /**
     * @Route("/{content}/delete", name="contentDelete")
     */
    public function delete(ContentRepository $contentRepository, Request $request, Content $content): Response
    {
        if ($request->isMethod('POST')) {
            $contentRepository->delete($content);
            $this->addFlash(FlashLevels::SUCCESS, "Content {$content->getSlug()} has been deleted");

            return $this->redirectToRoute('contentList');
        }

        return $this->render('admin/contentDelete.html.twig', [
            'content' => $content,
            'name' => $content->getTitle(),
        ]);
    }

    private function processContentForm(
        ContentRepository $contentRepository,
        Request $request,
        ContentDto $contentDto,
        bool $isCreate
    ): Response {
        $form = $this->createForm(ContentDtoType::class, $contentDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $content = $contentDto->asContent();
            $contentRepository->persist($content);
            $message = "Content {$content->getSlug()} ".($isCreate ? 'created' : 'updated');
            $this->addFlash(FlashLevels::SUCCESS, $message);

            return $this->redirectToRoute('contentList');
        }

        return $this->render('admin/contentForm.html.twig', [
            'isCreate' => $isCreate,
            'form' => $form->createView(),
        ]);
    }
}
