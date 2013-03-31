<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            
            new FOS\UserBundle\FOSUserBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Io\TcpdfBundle\IoTcpdfBundle(),
            //Vespolina
//            new Vespolina\AdminBundle\VespolinaAdminBundle,
//            new Vespolina\CartBundle\VespolinaCartBundle,
//            new Vespolina\CheckoutBundle\VespolinaCheckoutBundle,
//            new Vespolina\MerchandiseBundle\VespolinaMerchandiseBundle,
//            new Vespolina\OrderBundle\VespolinaOrderBundle,
//            new Vespolina\PartnerBundle\VespolinaPartnerBundle(),
//            new Vespolina\PricingBundle\VespolinaPricingBundle,
//            new Vespolina\ProductBundle\VespolinaProductBundle,
//            new Vespolina\TaxationBundle\VespolinaTaxationBundle,
//            new Vespolina\WorkflowBundle\VespolinaWorkflowBundle,
//            new Vespolina\DocumentBundle\VespolinaDocumentBundle,
            //Landensia Bundles
            new Ladensia\CoreBundle\LadensiaCoreBundle(),
            new Ladensia\AdminBundle\LadensiaAdminBundle(),
            new Ladensia\UserBundle\LadensiaUserBundle(),
            new Ladensia\EcashBundle\LadensiaEcashBundle(),
            new Ladensia\ConnectionBundle\LadensiaConnectionBundle(),
            new Ladensia\EmailBundle\LadensiaEmailBundle(),
            
            new Ladensia\Store\SupportBundle\LadensiaStoreSupportBundle(),
            new Ladensia\Store\MarketingBundle\LadensiaStoreMarketingBundle(),
            new Ladensia\Store\CmsBundle\LadensiaStoreCmsBundle(),
            new Ladensia\Store\WebshopBundle\LadensiaStoreWebshopBundle(),
            new Ladensia\Store\ProductBundle\LadensiaStoreProductBundle(),
            new Ladensia\Store\CheckoutBundle\LadensiaStoreCheckoutBundle(),
            new Ladensia\Store\CartBundle\LadensiaStoreCartBundle(),
//            new Ladensia\ProductBundle\LadensiaProductBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            /*$bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();*/
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
