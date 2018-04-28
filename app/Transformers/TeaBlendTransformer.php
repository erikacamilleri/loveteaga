<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TeaBlend;

/**
 * Description of TeaBlendTransformer
 *
 * @author erika
 */
class TeaBlendTransformer extends TransformerAbstract {
    
    protected $defaultIncludes = [
      'type', 'ingredients'
    ];
    
    public function transform(TeaBlend $blend)
    {
        if($blend === null) { 
            return [];
        }
    
        return [
            'id' => $blend->getId(),
            'code' => $blend->getCode(),
            'description' => $blend->getDescription(),
        ];
    }
    
    public function includeType(TeaBlend $blend)
    {
        return $this->item($blend->getType(), new TeaTypeTransformer());
    }
    
    public function includeIngredients(TeaBlend $blend)
    {
        return $this->collection($blend->getIngredients(), new TeaBlendIngredientRoleTransformer());
    }
}
