<?php

namespace App\Transformers;

use App\Entities\TeaIngredient;
use League\Fractal\TransformerAbstract;

/**
 * Description of TeaTypeTransformer
 *
 * @author erika
 */
class TeaIngredientTransformer extends TransformerAbstract {
    
    public function transform(TeaIngredient $ingredient)
    {
        if($ingredient === null) { 
            return [];
        }
        
        return [
            'id' => $ingredient->getId(),
            'description' => $ingredient->getDescription()
        ];
    }
}
