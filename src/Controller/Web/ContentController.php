<?php

declare(strict_types=1);

namespace App\Controller\Web;

use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ContentController extends AbstractController
{
    /**
     * @Route("/{slug}", name="content")
     */
    public function content(string $slug, ContentRepository $contentRepository): Response
    {
        $content = $contentRepository->findBySlug($slug);
        if (null === $content) {
            throw new NotFoundHttpException();
        }

        return $this->render('content.html.twig', [
            'content' => $content,
            'page' => '',
        ]);
    }
}
