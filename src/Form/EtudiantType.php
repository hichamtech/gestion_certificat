<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeApogee')
            ->add('nom')
            ->add('prenom')
            ->add('cne')
            ->add('cin')
            ->add('dateNaissance')
            ->add('villeNaissance')
            ->add('paysNaissance')
            ->add('sexe')
            ->add('adresse')
            ->add('anneePremiereInscription')
            ->add('anneePremiereInscriptionSup')
            ->add('anneePremiereInscriptionUniMaro')
            ->add('codeBac')
            ->add('serieBac')
            ->add('filiere')
            ->add('inscription')
            ->add('demande')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
