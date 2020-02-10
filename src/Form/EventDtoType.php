<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\Sponsor;
use App\Entity\Venue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventDtoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('date', DateType::class, [
                'input' => 'datetime_immutable',
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
            ->add('meetupId', TextType::class, [
                'required' => false,
            ])
            ->add('originalRelativeUrl', TextType::class, [
                'required' => false,
            ])
            ->add('organisers', EntityType::class, [
                'class' => Person::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => true,
                'group_by' => function (Person $choice, $key, $value): string {
                    return $choice->isOrganiser() ? 'Organiser' : 'Other';
                },
                'required' => false,
            ])
            ->add('sponsors', EntityType::class, [
                'class' => Sponsor::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => true,
                'group_by' => function (Sponsor $choice, $key, $value): string {
                    return $choice->isCurrentSponsor() ? 'Current' : 'Other';
                },
                'required' => false,
            ])
            ->add('venue', EntityType::class, [
                'class' => Venue::class,
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('pub', EntityType::class, [
                'class' => Venue::class,
                'choice_label' => 'name',
                'required' => false,
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EventDto::class,
        ]);
    }
}
