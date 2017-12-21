<?php

namespace AppBundle\Form;

use AppBundle\Repository\CompaniesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PositionsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('jobDescription', TextAreaType::class)
            ->add('email', EmailType::class)
            ->add('company', EntityType::class, ['class' => 'AppBundle\Entity\Companies',
                'query_builder' => function (CompaniesRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',])
            ->add('save', SubmitType::class, ['label' => 'Create position'])
            ->getForm();
    }
}
