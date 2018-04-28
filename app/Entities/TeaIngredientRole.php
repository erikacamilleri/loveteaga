<?php
namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="wp_9jjhmy0vcy_lt_tea_ingredient_roles")
 */
class TeaIngredientRole {
    
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;
    
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $description;
    
    /**
     * @var float
     * @ORM\Column(type="float")
     */
    protected $ratio;
    
    public function __construct($name, $description, $ratio) {
        $this->name = $name;
        $this->description = $description;
        $this->ratio = $ratio;
    }
    
    function getId() {
        return $this->id;
    }
    
    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getRatio() {
        return $this->ratio;
    }
    
    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setRatio($ratio) {
        $this->ratio = $ratio;
    }
}
