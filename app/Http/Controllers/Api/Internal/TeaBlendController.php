<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api\Internal;

use App\Http\Controllers\Api\ApiController;
use App\Transformers\TeaBlendTransformer;
use App\Repositories\TeaBlends;

/**
 * Description of TeaBlendController
 *
 * @author erika
 */
class TeaBlendController extends ApiController {
    
    public function index(TeaBlends $blends)
    {
        $all = $blends->all();
        return $this->respondWithCollection($all, new TeaBlendTransformer(), null);
    }
}
