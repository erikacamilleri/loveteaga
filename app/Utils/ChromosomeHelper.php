<?php
namespace App\Utils;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChromosomeHelper
 *
 * @author erika
 */
class ChromosomeHelper {
    //put your code here
    public static function toPosRole(array $chrom) 
    {
        $blend = [];
        $ingredient_count = 0;
        for($i = 0; $i < count($chrom); $i = $i+2) {
            $ingredient_count++;
            $gene = trim(str_replace(' ', '', $chrom[$i] . '' . $chrom[$i+1]));
            if ($gene == '01') {
                array_push($blend, 'Ingredent ' . $ingredient_count . ' Active.');
            } else if ($gene == '10') {
                array_push($blend, 'Ingredent ' . $ingredient_count . ' Supporting.');
            } else if ($gene == '11') {
                array_push($blend, 'Ingredent ' . $ingredient_count . ' Catalyst.');
            }
        }
        return $blend;
    }
}
