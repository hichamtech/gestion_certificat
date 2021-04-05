<?php

namespace App\Form;

use App\Entity\TypeDemande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeDemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('libele',ChoiceType::class,[
            'choices' => [
                'Certificat de scolarité' => TypeDemande::TYPE_SCOLARITE,
                'Relevé des notes' => TypeDemande::TYPE_RELEVE,
                'Demande de stage' => TypeDemande::TYPE_STAGE
            ]
        ])
            ->add('nombreMax')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TypeDemande::class,
        ]);
    }
}
