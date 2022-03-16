<?php

namespace App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use GuzzleHttp\Psr7\Request;

class EvaluationService
{
    protected $evaluationRepository, $orderRepository;
    public function __construct(EvaluationRepositoryInterface $evaluationRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->evaluationRepository = $evaluationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function createNewEvaluation(string $identifyOrder, array $evaluation)
    {
        $clientId =  $this->getClient();
        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

        return $this->evaluationRepository->newEvaluationOrder($order->id, $clientId, $evaluation);
    }
    private function getClient()
    {
        return auth()->user()->id;
    }
}