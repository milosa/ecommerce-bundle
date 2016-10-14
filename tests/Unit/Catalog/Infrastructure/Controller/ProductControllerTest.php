<?php

declare(strict_types=1);

namespace Milosa\EcommerceBundle\Tests\Unit\Catalog\Infrastructure\Controller;

use Milosa\EcommerceBundle\Catalog\Infrastructure\Controller\ProductController;
use Symfony\Component\HttpFoundation\Response;

class ProductControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testViewActionReturnsResponse()
    {
        $this->markTestSkipped();
        $controller = new ProductController();

        $result = $controller->viewAction(1);

        $this->assertInstanceOf(Response::class, $result);
    }
}
