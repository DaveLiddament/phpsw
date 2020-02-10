<?php

declare(strict_types=1);

namespace App\Form;

use App\Validator\MeetupIdConstraint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeetupIdType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints' => [
                new MeetupIdConstraint(),
            ],
        ]);
    }

    public function getParent(): string
    {
        return TextType::class;
    }
}
