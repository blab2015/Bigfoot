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
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Bigfoot\Bundle\ContextBundle\BigfootContextBundle(),
            new Bigfoot\Bundle\SeoBundle\BigfootSeoBundle(),
            new Bigfoot\Bundle\CoreBundle\BigfootCoreBundle(),
            new JMS\TwigJsBundle\JMSTwigJsBundle(),
        );

        if (in_array($this->getEnvironment(), array('admin', 'admin_dev'))) {
            $bundles[] = new Bigfoot\Bundle\NavigationBundle\BigfootNavigationBundle();
            $bundles[] = new Bigfoot\Bundle\MediaBundle\BigfootMediaBundle();
            $bundles[] = new Bigfoot\Bundle\ImportBundle\BigfootImportBundle();
            $bundles[] = new Bigfoot\Bundle\UserBundle\BigfootUserBundle();
        }

        if (in_array($this->getEnvironment(), array('dev', 'test', 'admin_dev'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new atoum\AtoumBundle\AtoumAtoumBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    protected function initializeContainer() {
        parent::initializeContainer();
        if (PHP_SAPI == 'cli') {
            $this->getContainer()->enterScope('request');
            $this->getContainer()->set('request', new \Symfony\Component\HttpFoundation\Request(), 'request');
        }
    }
}
