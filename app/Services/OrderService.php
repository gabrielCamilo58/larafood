<?php

namespace App\Services;

use App\Http\Requests\Api\StoreOrder;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\ProductsRepository;

class OrderService
{
    protected $orderRepository, $tenantRepository, $tableRepository, $productsRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, TenantRepositoryInterface $tenantRepository, TableRepositoryInterface $tableRepository, ProductsRepository $productsRepository)
    {
      $this->orderRepository = $orderRepository; 
      $this->tenantRepository = $tenantRepository; 
      $this->tableRepository = $tableRepository;
      $this->productsRepository = $productsRepository;
    }

    public function createNewOrder( array $order)
    {
      $productsOrder = $this->getProductsByOrder($order['products'] ?? []);

      $identify = $this->getIdentifyOrder();
      $total = $this->getTotalOrder($productsOrder);
      $status = 'open';
      $tenantId = $this->getTenantIdOrder($order['token_company']);
      $comment = isset($order['comment']) ? $order['comment'] : '';
      $clientId = $this->getClientIdOrder();
      $tableId = $this->getTableIdOrder($order['table'] ?? '');

      $order = $this->orderRepository->createNewOrder( $identify, $total, $status, $tenantId, $comment, $clientId, $tableId);

      $this->orderRepository->registerProductsOrder($order['id'], $productsOrder);


      return $order;

    }

    public function getOrderByIdentify($identify)
    {
      return $this->orderRepository->getOrderByIdentify($identify);
    }
    private function getIdentifyOrder(int $qtdyCaracters = 8)
    {
      $smallLeters = str_shuffle('abcdefghijklmnopqxyrz');
      $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
      $numbers .= 1234567890;

      $characters = $smallLeters.$numbers; 

      $identify = substr(str_shuffle($characters), 0, $qtdyCaracters);

      if($this->orderRepository->getOrderByIdentify($identify))
        $this->getIdentifyOrder($qtdyCaracters + 1);

      return $identify;
    }

    public function getTotalOrder(array $products):float
    {
      $total = 0;

      foreach ($products as $product){
        $total += ($product['price'] * $product['qty']);
      }
      return $total;
    }

    private function getTenantIdOrder(string $uuid)
    {
      $tenant = $this->tenantRepository->getTenantByUuid($uuid);
      return $tenant->id;
    }

    private function getTableIdOrder(string $uuid = '')
    {
      if($uuid) {
        $table = $this->tableRepository->getTableByUuid($uuid);
        return $table->id;
      }

      
      return '';
    }
    private function getClientIdOrder()
    {
        $client = auth()->check() ? auth()->user()->id : '';

        return $client;
    }

    private function getProductsByOrder(array $productsOrder): array
    {
      $products = [];
      foreach($productsOrder as $productOrder){
        $product = $this->productsRepository->getProductByUuid($productOrder['identify']);

        array_push($products, [
          'id' => $product->id,
          'qty' => $productOrder['qty'],
          'price' => $product->price,
        ]);
      }

      return $products;
    }

    public function ordersByClient()
    {
       $clientId = $this->getClientIdOrder();

       return $this->orderRepository->getOrdersByClientId($clientId);
    }
}