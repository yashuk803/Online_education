<?php

namespace App\Form;

use App\Entity\Lesson;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название урока',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class, [
                'required'   => false,
                'label' => 'Описание урока',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('videoFile');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
