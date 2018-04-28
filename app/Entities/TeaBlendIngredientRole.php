<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use App\Entities\TeaBlend;

/**
 * @ORM\Entity
 * @ORM\Table(name="wp_9jjhmy0vcy_lt_tea_blend_ingredient_roles")
 */
class TeaBlendIngredientRole {
    
    /**
     * @var integer $id
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="TeaIngredient")
     * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")
     */
    protected $ingredient;
    
    /**
     * @ORM\ManyToOne(targetEntity="TeaIngredientRole")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    protected $role;
    
    /**
     * @var TeaBlend
     * @ORM\ManyToOne(targetEntity="TeaBlend", inversedBy="ingredients") 
     */
    protected $blend;
    
    public function __construct($ingredient, $role, $blend)
    {
        $this->role = $role;
        $this->ingredient = $ingredient;
        $this->blend = $blend;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getIngredient()
    {
        return $this->ingredient;
    }
    
    public function getRole()
    {
        return $this->role;
    }
}
