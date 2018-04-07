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
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomevenement')
            ->add('date',DateTimeType::class)
            ->add('lieu')
            ->add('nombredeplaces')
            ->add('tarifevenement')
            ->add('file')
            ->add('descriptionevenement',TextareaType::class);
//            ->add('Ajouter',SubmitType::class)
//            ->setMethod('POST');
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoukElMedina\PidevBundle\Entity\Evenements'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'soukelmedina_pidevbundle_evenements';
    }
}
