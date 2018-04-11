<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21/03/2018
 * Time: 18:16
 */

namespace SoukElMedina\EvenementBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class UpdateType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomMagasin')
            ->add('dateCreationMagasin',DateTimeType::class)
            ->add('contactMagasin')
            ->add('numeroMagasin')
            ->add('adresseMagasin')
            ->add('file')
            ->add('descriptionMagasin',TextareaType::class);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoukElMedina\PidevBundle\Entity\Magasins'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'soukelmedina_pidevbundle_magasins';
    }
}
