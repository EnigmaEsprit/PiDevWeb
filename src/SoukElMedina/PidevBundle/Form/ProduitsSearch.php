<?php

namespace SoukElMedina\PidevBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsSearch extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prixproduit', RangeType::class, array(
                'attr' => array(
                    'min' => 1,
                    'max' => 50
                )
            ))
            ->add('categoriemagasin', ChoiceType::class, array(

                    'choices' => array(
                        ''=>'',
                        'vetements' => 'vetements',
                        'decorations' => 'decorations',
                        'meuble' => 'meuble',
                        'artisanal' => 'artisanal',
                        'plantes' => 'plantes',

                    ),

                    'required'    => false,)

            );


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoukElMedina\PidevBundle\Entity\Produits'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'soukelmedina_pidevbundle_produits';
    }


}
