<?php

namespace SoukElMedina\PromotionBundle\Form;


use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PromotionsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nompromotion')
//            ->add('datedebut')
//            ->add('datefin')
            ->add('pourcentage',IntegerType::class,array('attr'=>array('min'=>1,'max'=>100)))
            ->add('file')
            ->add('idproduit');
//        ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
//            $projet = $event->getData(); //ici tu récupère ton objet Projet avec l'entreprise que tu lui as assigné.
//            var_dump($projet);
//            $event->getForm()->add('idproduit', EntityType::class, array(
//                'class' => 'SoukElMedina\PidevBundle\Entity\Produits',
//                'query_builder' => function (EntityRepository $er) use ($projet) {
//                    //je te laisserais regarder la doc pour le query_builder. Mais tu dois return un QueryBuilder, sois que tu fais directement ici, soit que tu as fais dans ton repository. Dans mon cas, je pars du principe que tu le fais dans ton repository
//                    return $er->qbProduit($projet->getIdproduit()->getIdproduit()); //suis nul pour donner des noms à mes méthodes ^^ Mais la tu construit une requête qui va chercher les utilisateurs de ton entreprise uniquement
//                },
//                'label' => 'Attribuer un utilisateur au projet : '));
//            ->add('iduser');

//    });
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SoukElMedina\PidevBundle\Entity\Promotions'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'soukelmedina_pidevbundle_promotions';
    }


}
