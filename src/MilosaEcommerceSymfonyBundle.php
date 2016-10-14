<?php

declare(strict_types=1);

namespace Milosa\EcommerceSymfony;

use Milosa\EcommerceSymfony\DependencyInjection\EcommerceSymfonyExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MilosaEcommerceSymfonyBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EcommerceSymfonyExtension();
        }
        if ($this->extension) {
            return $this->extension;
        }
    }
}
