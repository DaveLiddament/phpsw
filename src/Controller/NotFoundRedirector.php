<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundRedirector
{
    public static function assertFound(?object $entity): void
    {
        if (null === $entity) {
            throw new NotFoundHttpException();
        }
    }
}
