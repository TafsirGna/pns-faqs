<?php

namespace App\Form;

use App\Entity\Faq;
use App\Entity\Platform;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewPlatformType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('catisId')
            ->add('faq', EntityType::class, [
                "class" =>  Faq::class,
                "choice_label"  =>  "name",
                "multiple"  =>  false,
                "expanded"  =>  false,
                "required"  =>  true,
                "label"     =>  "Faq",
                // "query_builder" => function(SessionRepository $repository) use ($organisateur){
                //     return $repository->getAllOfOrgQueryBuilder($this->security);
                // },
            ])
            ->add('save', SubmitType::class, ['label' => "Save"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Platform::class,
        ]);
    }
}
