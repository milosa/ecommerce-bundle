<?php

declare(strict_types=1);

namespace Milosa\EcommerceBundle\Tests\Functional\Catalog\Infrastructure\Controller;

use Milosa\Ecommerce\Catalog\Domain\Catalog\Product\Product;
use Milosa\Ecommerce\Catalog\Domain\Catalog\Product\ProductId;


use Milosa\EcommerceBundle\Tests\Functional\Application\AppKernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    private $client;

    protected static function createKernel(array $options = array())
    {
        return new AppKernel(
            isset($options['config']) ? $options['config'] : 'config.yml'
        );
    }

    public function setUp()
    {
        //self::bootKernel();
        $this->client = static::createClient(['config' => 'config.yml']);
    }

    public function testRequestingExistingProductIsSuccessful()
    {
        $id = 1;
        $repository = static::$kernel->getContainer()->get('product_repository');
        $repository->add(new Product(new ProductId($id), 'name'));

        $this->client->request('GET', '/product/1');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testRequestingNonExistingProductReturnsNotFound()
    {
        $this->client->request('GET', '/product/1');

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
    }
}
