<?php
namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="wp_9jjhmy0vcy_lt_tea_ingredients")
 */
class TeaIngredient {
    
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    protected $description;
    
    public function __construct($description) {
        $this->description = $description;
    }
    
    function getId()
    {
        return $this->id;
    }
    
    function getDescription() 
    {
        return $this->description;
    }

    function setDescription($description) 
    {
        $this->description = $description;
        return $this;
    }
}
