<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\storeEvaluationOrder;
use App\Http\Resources\EvaluationResource;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

class EvaluationApiControler extends Controller
{
    protected $evaluationService;
    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }
    public function store(storeEvaluationOrder $request)
    {
        $data = $request->only('stars', 'comment');

        $evaluation = $this->evaluationService->createNewEvaluation($request->identify, $data);

        return new EvaluationResource($evaluation);
    }
}
