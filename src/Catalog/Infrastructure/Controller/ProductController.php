<?php

declare(strict_types=1);

namespace Milosa\EcommerceSymfony\Catalog\Infrastructure\Controller;

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
            $viewProductService->execute($request);
        } catch (ProductNotFoundException $e) {
            throw $this->createNotFoundException('The product does not exist');
        }


        return new Response();
    }
}
