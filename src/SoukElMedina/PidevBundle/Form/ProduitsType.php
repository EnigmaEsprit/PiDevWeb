<?php

namespace SoukElMedina\PidevBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('referenceproduit')
            ->add('nomproduit')
            ->add('prixproduit')
            ->add('file')
            ->add('quantiteproduit')
            ->add('active', ChoiceType::class, array(

                    'choices' => array(
                        ''=>'',
                        'true' => 'true',
                        'false' => 'false',


                    ),
                )
            )
            ->add('idpromotion')
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
            )
            ->add('Ajouter',SubmitType::class);
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
