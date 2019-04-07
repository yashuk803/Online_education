<?php

/*
 * This file is part of Symfony DEMO Onlain Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form;

use App\Entity\Course;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название курса',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('shortDescription', TextareaType::class, [
                'required'   => false,
                'label' => 'Краткое описание курса',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class, [
                'required'   => false,
                'label' => 'Полное описание курса',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('cost', MoneyType::class, [
                'currency' => '',
                'label' => 'Цена ₴',
                'attr' => ['class' => 'form-control'],
            ])->add('videoFile')
            ->add('access_type', CheckboxType::class, [
                'label'    => 'Опубликовать курс?',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
