<?php

namespace App\Form;

use App\Entity\Faq;
use App\Entity\Plateform;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class NewFaqType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                
            ])
            ->add('description', TextareaType::class)
            // ->add('createdAt')
            // ->add('createdBy')
            ->add('plateform', EntityType::class, [
                "class" =>  Plateform::class,
                "choice_label"  =>  "name",
                "multiple"  =>  false,
                "expanded"  =>  false,
                "required"  =>  true,
                "label"     =>  "Plateform",
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
            'data_class' => Faq::class,
        ]);
    }
}
