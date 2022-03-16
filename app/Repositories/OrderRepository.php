<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function createNewOrder(string $identify, float $total, string $status, int $tenantId,  string $comment = '', $clientId = '', $tableId = '')
    {

        $data = [
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'tenant_id' => $tenantId,
            'comment' => $comment,
        ];

        if ($clientId) $data['client_id'] = $clientId;
        if($tableId) $data['table_id'] = $tableId;

        $order = $this->order->create($data);

        return $order;
    }
    public function getOrderByIdentify(string $identify)
    {
        return $this->order->where('identify', $identify)->first();
    }
    public function registerProductsOrder(int $orderId, array $products)
    {
        $orderProducts = [];

        foreach($products as $product){

            array_push($orderProducts, [
                'order_id' => $orderId,
                'product_id' => $product['id'],
                'qty' => $product['qty'],
                'price' =>  $product['price'],
            ]);
        }

        DB::table('order_product')->insert($orderProducts);

        // $order = $this->order->find($orderId);

        // $orderProducts = [];

        // foreach($products as $product){
        //     $orderProducts[$product['id']] = [
        //         'qty' => $product['qty'],
        //         'price' => $product['price']
        //     ];
        // }

        // $order->products()->attach($orderProducts);
    }
    public function getOrdersByClientId($clientId)
    {
        $orders = $this->order->where('client_id', $clientId)->paginate();

        return $orders;
    }
}