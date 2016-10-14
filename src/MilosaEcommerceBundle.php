<?php

declare(strict_types=1);

namespace Milosa\EcommerceBundle;

use Milosa\EcommerceBundle\DependencyInjection\EcommerceExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MilosaEcommerceBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EcommerceExtension();
        }
        if ($this->extension) {
            return $this->extension;
        }
    }
}
