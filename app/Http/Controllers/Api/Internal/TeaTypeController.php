<?php
namespace App\Http\Controllers\Api\Internal;

use App\Http\Controllers\Api\ApiController;
use App\Repositories\TeaTypes;
use App\Transformers\TeaTypeTransformer;
use Illuminate\Http\Request;
use App\Entities\TeaType;

class TeaTypeController extends ApiController {
    
    public function index(TeaTypes $teaTypes)
    {
        $all = $teaTypes->all();
        return $this->respondWithCollection($all, new TeaTypeTransformer());
    }
    
    public function store (Request $request, TeaTypes $teaTypes)
    {
        try {
           $data = collect($request->all()); 
           $entity = new TeaType($data->get('description'));
           $teaTypes->add($entity);
           return $this->respondWithItem($entity,  new TeaTypeTransformer());
        } catch (\Exception $e) {
          return $this->respondWithError($e->getTraceAsString(), 400);
        }
    }
}
