<?php
declare(strict_types = 1);

namespace Milosa\EcommerceSymfony\Tests\Functional\Catalog\Infrastructure\Controller;


use Milosa\EcommerceSymfony\Catalog\Infrastructure\Controller\ProductController;
use Milosa\Ecommerce\Catalog\Infrastructure\Persistence\InMemoryProductRepository;
use Milosa\Ecommerce\Catalog\Application\Service\Product\ViewProductRequest;
use Milosa\Ecommerce\Catalog\Application\Service\Product\ViewProductService;
use Milosa\Ecommerce\Catalog\Domain\Catalog\Product\Product;
use Milosa\Ecommerce\Catalog\Domain\Catalog\Product\ProductId;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class ProductControllerTest extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    private $client;

    public function setUp()
    {
        self::bootKernel();
        $this->client = static::createClient();
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
