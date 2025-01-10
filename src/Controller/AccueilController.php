<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    public function affichage(string $nom): Response {
        return new Response("La valeur saisie est: $nom");       
    }

    public function calculatrice(int $n1, int $n2, string $op){
        $reponse ='';
        if ($n1 < 0 || $n2 < 0){
            return new Response("<p>Les nombres sont négatifs</p>");
        }else{
            switch($op){
                case "add":
                    $reponse = "<p>L'addition de {$n1} et {$n2} est égale au résultat :".($n1+$n2)."</p>";
                    break;
                case "sous":
                    $reponse = "<p>La soustraction de {$n1} et {$n2} est égale au résultat : ".($n1-$n2)."</p>";
                    break;
                case "multi":
                    $reponse = "<p>La multiplication de {$n1} et {$n2} est égale au résultat : ".($n1*$n2)."</p>";
                    break;
                case "div":
                    $reponse = "<p>La division de {$n1} et {$n2} est égale au résultat :".($n1/$n2)."</p>";
                    break;
                default:
                    $reponse = "<p>Merci de rentrer un opérateur correct!</p>";
                    break;
            }
            return new Response($reponse);
        }
    }
}
