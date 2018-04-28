<?php
namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="wp_9jjhmy0vcy_lt_tea_blends")
 */
class TeaBlend {
    
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *  @var string $code
     *  @ORM\Column(name="code", type="string", nullable=true)
     */
    protected $code;
    
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $description;
    
    /**
     * Many TeaBlend have one TeaType
     * @var TeaType
     * @ORM\ManyToOne(targetEntity="TeaType") 
     * @ORM\JoinColumn(name="tea_type_id", referencedColumnName="id")
    */
    protected $type;
    
    /**
     * @var ArrayCollection
     * One tea blend has many tea ingredient roles
     * @ORM\OneToMany(targetEntity="TeaBlendIngredientRole", mappedBy="blend", cascade={"persist"})
     */
    protected $ingredients;
    
    public function __construct($code, $description, $type)
    {
        $this->code = $code;
        $this->description = $description;
        $this->type = $type;
        $this->ingredients = new ArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getCode()
    {
        return $this->code;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function getIngredients()
    {
        return $this->ingredients;
    }
    
    public function addIngredient(TeaBlendIngredientRole $ingredient)
    {
        $this->ingredients->add($ingredient);
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
}