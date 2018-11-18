<?php

require_once ('Personnage.php');
require_once ('PersonnagesManager.php');

// // On admet que $db est un objet PDO
// $request = $db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages');

// while($donnees = $request->fetch(PDO::FETCH_ASSOC))// chaque entrée sera récupérée et placée dans un array
// {
//     // on passe les données (stockées dans un tableau) concernant le personnage au constructeur de la classe
//     // on admet que le constructeur de la classe appelle chaque setter pour lui assigner les valeurs qu'on lui a donné aux attributs correspondant
//     $perso = new Personnage($donnees);
    
//     echo $perso->nom(), ' a ', $perso->forcePerso(), ' de force, ', $perso->degats(), ' de dégâts, ', $perso->experience(), ' d\'experience et est de niveau ', $perso->niveau();
// }