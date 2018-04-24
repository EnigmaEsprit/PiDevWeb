<?php

namespace SoukElMedina\ReclamationBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('typereclamation')
            ->add('objetreclamation', TextType::class, array(
                'required'=>true
            ))

            ->add('idmagasin', EntityType::class, array(
                'class'=>'SoukElMedinaPidevBundle:Magasins',
                'choice_label'=>'nommagasin',
                'placeholder' => '--  Sélectionner le magasin  --',
                'multiple'=>false,
                'required'=>true,
            ))

            ->add('contenureclamation', TextareaType::class, array(
                'required'=>true,
            ));
   }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoukElMedina\PidevBundle\Entity\Reclamations'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'soukelmedina_reclamationbundle_reclamations';
    }


}
