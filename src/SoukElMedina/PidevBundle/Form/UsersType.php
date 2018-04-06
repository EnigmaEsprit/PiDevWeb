<?php
//src/SoukElMedina/Form/UsersType.php
namespace SoukElMedina\PidevBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class UsersType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('prenom')
            ->add('datedenaissance',DateType::class)
            ->add('sexe')
            ->add('adresse')
            ->add('ville')
            ->add('zip',IntegerType::class,array('attr'=>array('style'=>'	outline: none;
    border: 1px solid #DBDBDB;
    padding: 10px 10px 10px 10px;
    font-size: 14px;
    color: #999;
    display: block;
    width: 100%;'),))
            ->add('numerodutelephone',IntegerType::class,array('attr'=>array('min'=>20000000,'max'=>99999999,'style'=>'	outline: none;
    border: 1px solid #DBDBDB;
    padding: 10px 10px 10px 10px;
    font-size: 14px;
    color: #999;
    display: block;
    width: 100%;'),))
            ->add('pub', CheckboxType::class, array(
                'label'    => 'Vous devez recevoir des publicitaires ?',
                'required' => false,

            ));
//            ->add('type');
//            ->add('imageuser')
//            ->add('numerodecartebancaire')
//            ->add('datedevalidation')
//            ->add('codesecret')
//            ->add('situaitionfiscal')
//            ->add('ribbancaire');
    }
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoukElMedina\PidevBundle\Entity\Users'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'soukelmedina_pidevbundle_users';
    }


}
