<?php

namespace App\Transformers;

use App\Entities\TeaIngredientRole;
use League\Fractal\TransformerAbstract;

/**
 * Description of TeaTypeTransformer
 *
 * @author erika
 */
class TeaIngredientRoleTransformer extends TransformerAbstract {
    
    public function transform(TeaIngredientRole $role)
    {
        if($role === null) { 
            return [];
        }
    
        return [
            'id' => $role->getId(),
            'name' => $role->getName(),
            'description' => $role->getDescription(),
            'ratio' => $role->getRatio(),
        ];
    }
}
