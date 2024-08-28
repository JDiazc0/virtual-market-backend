<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\promotion;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PromotionController extends Controller
{
    // Get promotions
    public function getPromotion()
    {
        $promotion = Promotion::all();

        return response()->json($promotion, Response::HTTP_OK);
    }
}
