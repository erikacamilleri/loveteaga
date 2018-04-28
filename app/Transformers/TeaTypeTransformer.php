<?php

namespace App\Transformers;

use App\Entities\TeaType;
use League\Fractal\TransformerAbstract;

/**
 * Description of TeaTypeTransformer
 *
 * @author erika
 */
class TeaTypeTransformer extends TransformerAbstract {
    
    public function transform(TeaType $teaType)
    {
        if($teaType === null) { 
            return [];
        }
    
        return [
            'id' => $teaType->getId(),
            'description' => $teaType->getDescription()
        ];
    }
}
