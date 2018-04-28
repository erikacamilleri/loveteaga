<?php

namespace App\Repositories;

/**
 * Description of TeaTypes
 *
 * @author erika
 */
class TeaIngredients extends DoctrineRepository {
    
    public function setRepository() {
        $this->repo = $this->orm->getRepository('App\Entities\TeaIngredient');
    }
}
