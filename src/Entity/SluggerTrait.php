<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\String\Slugger\AsciiSlugger;

trait SluggerTrait
{
    private function asSlug(string $value): string
    {
        $slugger = new AsciiSlugger();

        return $slugger->slug($value)->toString();
    }
}
