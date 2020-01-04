<?php

declare(strict_types=1);


namespace App\Controller;


use _HumbugBox3ab8cff0fda0\___PHPSTORM_HELPERS\object;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundRedirector
{

    public static function assertFound(?object $entity): void
    {
        if ($entity === null) {
            throw new NotFoundHttpException();
        }
    }
}
