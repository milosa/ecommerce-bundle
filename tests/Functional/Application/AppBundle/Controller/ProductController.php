<?php

declare(strict_types=1);

namespace Milosa\EcommerceBundle\Tests\Functional\Application\AppBundle\Controller;

use Milosa\Ecommerce\Catalog\Application\Service\Product\ProductNotFoundException;
use Milosa\Ecommerce\Catalog\Application\Service\Product\ViewProductRequest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function viewAction($productId)
    {
        $viewProductService = $this->get('view_product_service');
        $request = new ViewProductRequest($productId);
        try {
            $product = $viewProductService->execute($request);
        } catch (ProductNotFoundException $e) {
            throw $this->createNotFoundException('The product does not exist');
        }

        //$response = new Response('<h1>'.$product->name().'</h1><p>ID:'.$product->id()->id().'</p>');




        return $this->render('MilosaEcommerceBundle::product.html.twig', ['product_name' => $product->name(), 'product_id' => $product->id()->id()]);
    }
}
