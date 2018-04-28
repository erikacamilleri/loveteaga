<?php
namespace App\Http\Controllers\Api\Internal;

use App\Http\Controllers\Api\ApiController;
use App\Repositories\TeaIngredientRoles;
use App\Transformers\TeaIngredientRoleTransformer;
use Illuminate\Http\Request;
use App\Entities\TeaIngredientRole;

class TeaIngredientRoleController extends ApiController {
    
    public function index(TeaIngredientRoles $roles)
    {
        $all = $roles->all();
        return $this->respondWithCollection($all, new TeaIngredientRoleTransformer());
    }
    
    public function store (Request $request, TeaIngredientRoles $roles)
    {
        try {
           $data = collect($request->all());
           $entity = new TeaIngredientRole($data->get('name'), $data->get('description'), $data->get('ratio'));
           $roles->add($entity);
           return $this->respondWithItem($entity,  new TeaIngredientRoleTransformer());
        } catch (\Exception $e) {
          return $this->respondWithError($e->getTraceAsString(), 400);
        }
    }
}
