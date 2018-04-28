<?php

namespace App\Factories;

use Illuminate\Support\Collection;
use App\Models\TeaType;

/**
 * Description of TeaTypeFactory
 *
 * @author erika
 */
class TeaTypeFactory {
    
    public function create(Collection $data)
    {
        $description = $data->get('description');
        return new TeaType($description);
    }
}
