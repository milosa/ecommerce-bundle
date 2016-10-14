<?php

declare(strict_types=1);

namespace Milosa\EcommerceBundle\Tests\Functional\Application;

use Milosa\EcommerceBundle\MilosaEcommerceBundle;
use Milosa\EcommerceBundle\Tests\Functional\Application\AppBundle\AppBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function __construct($config, $debug = true)
    {
        parent::__construct('test', $debug);
        if (!(new Filesystem())->isAbsolutePath($config)) {
            $config = __DIR__.'/config/'.$config;
        }
        if (!file_exists($config)) {
            throw new \RuntimeException(sprintf('The config file "%s" does not exist.', $config));
        }
        $this->config = $config;
    }

    public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new TwigBundle(),
            new MilosaEcommerceBundle(),

            new AppBundle()
        ];

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->config);
    }
}
