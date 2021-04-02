<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('sexe',ChoiceType::class,[
                'choices' =>[
                    'Homme' => 'Homme',
                    'Femme' => 'Femme'
                ]
            ])
            ->add('adresse')
            ->add('anneePremiereInscription')
            ->add('anneePremiereInscriptionSup')
            ->add('anneePremiereInscriptionUniMaro')
            ->add('codeBac')
            ->add('serieBac',ChoiceType::class,[
                'choices'=>[
                    'Sciences de la Vie et de la Terre' => 'Sciences de la Vie et de la Terre',
                    'Sciences Physiques et Chimiques' => 'Sciences Physiques et Chimiques',
                    'Sciences Maths A' => 'Sciences Maths A',
                    'Sciences Maths B' => 'Sciences Maths B',
                    'Sciences Economiques' => 'Sciences Economiques',
                    'Techniques de Gestion et de Comptabilité' => 'Techniques de Gestion et de Comptabilité',
                    'Sciences agronomiques' => 'Sciences agronomiques',
                    'Sciences et Technologies Electriques' => 'Sciences et Technologies Electriques',
                    'Sciences et Technologies Mécaniques' => 'Sciences et Technologies Mécaniques',
                    'Arts Appliqués' => 'Arts Appliqués',
                    'Sciences Humaines' => 'Sciences Humaines',
                    'Sciences de la Chariaâ' => 'Sciences de la Chariaâ',
                    'Sciences de Langue Arabe' => 'Sciences de Langue Arabe'
                ]
            ])
            ->add('filiere')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
