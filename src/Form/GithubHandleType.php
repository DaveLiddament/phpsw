<?php

declare(strict_types=1);

namespace App\Form;

use App\Validator\GithubHandleConstraint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GithubHandleType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints' => [
                new GithubHandleConstraint(),
            ],
        ]);
    }

    public function getParent(): string
    {
        return TextType::class;
    }
}
