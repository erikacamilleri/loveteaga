<?php
namespace App\Http\Controllers\Api\Internal;

use App\Http\Controllers\Api\ApiController;
use App\Transformers\TeaIngredientTransformer;
use App\Repositories\TeaIngredients;
use Illuminate\Http\Request;
use App\Entities\TeaIngredient;

class TeaIngredientController extends ApiController {
    
    public function index(TeaIngredients $ingredients)
    {
        $all = $ingredients->all();
        return $this->respondWithCollection($all, new TeaIngredientTransformer(), null);
    }
    
    public function store(Request $request, TeaIngredients $ingredients)
    {
        try {
          $params = collect($request);
          $teaIngredient = new TeaIngredient($params->get('description'));
          $ingredients->add($teaIngredient);
          return $this->respondWithItem($teaIngredient, new TeaIngredientTransformer(), null);    
        } catch (\Exception $e) {
          return $this->respondWithError($e->getTraceAsString(), 400);
        }
    }
}
