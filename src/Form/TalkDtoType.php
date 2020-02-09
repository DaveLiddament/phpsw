<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TalkDtoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('abstract', TextType::class, [
                'required' => false,
            ])
            ->add('videoUrl', TextType::class, [
                'required' => false,
            ])
            ->add('slidesUrl', TextType::class, [
                'required' => false,
            ])
            ->add('joindinUrl', TextType::class, [
                'required' => false,
            ])
            ->add('showcase', CheckboxType::class, [
                'required' => false,
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TalkDto::class,
        ]);
    }
}
