<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TeaBlendIngredientRole;

/**
 * Description of TeaBlendIngredientRoleTransformer
 *
 * @author erika
 */
class TeaBlendIngredientRoleTransformer extends TransformerAbstract {
    
    protected $defaultIncludes = [
      'role', 'ingredient'
    ];
    
    public function transform(TeaBlendIngredientRole $ingredient)
    {
        if ($ingredient === null) { return []; }
        
        return [
            'id' => $ingredient->getId()
        ];
    }
    
    public function includeRole(TeaBlendIngredientRole $ingredient)
    {
        return $this->item($ingredient->getRole(), new TeaIngredientRoleTransformer());
    }
    
    public function includeIngredient(TeaBlendIngredientRole $ingredient)
    {
        return $this->item($ingredient->getIngredient(), new TeaIngredientTransformer());
    }
}
