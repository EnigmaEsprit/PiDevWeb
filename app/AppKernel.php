<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            new SoukElMedina\PidevBundle\SoukElMedinaPidevBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new SoukElMedina\EvenementBundle\SoukElMedinaEvenementBundle(),
            new SoukElMedina\PromotionBundle\SoukElMedinaPromotionBundle(),
            new SoukElMedina\CommentairesBundle\SoukElMedinaCommentairesBundle(),
            new SoukElMedina\DecouverteBundle\SoukElMedinaDecouverteBundle(),
            new SoukElMedina\MagasinsBundle\SoukElMedinaMagasinsBundle(),
            new SoukElMedina\PanierBundle\SoukElMedinaPanierBundle(),
            new SoukElMedina\ProduitBundle\SoukElMedinaProduitBundle(),
            new SoukElMedina\ReclamationBundle\SoukElMedinaReclamationBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Nomaya\SocialBundle\NomayaSocialBundle(),
            new ScayTrase\SmsDeliveryBundle\SmsDeliveryBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
