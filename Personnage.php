<?php

// Avant de créer une classe, il faut systématiquement se poser quelques questions : 

// Je commence par où ? 
// - Une classe est composée de 2 parties (eventuellement 3) : 

// --- une partie déclarant les attributs de la classe (= ce sont les caractéristiques de l'objet)
// --- une partie déclarant les méthodes de la classe (= ce sont les fonctionnalités de l'objet)
// --- une partie déclarant les constantes de la classe

// Lorsqu'on veut construire une classe il faut donc se poser les questions suivantes : 
// - Quels sont les caractéristiques de la classe ? 
// - Quels sont les fonctionnalités de la classe ? 

// une fois qu'on a les éléments à ces questions on peut commencer a construire la classe dans l'ordre : 
// 1- les attributs
// 2- les méthodes

class Personnage {
    
    // on commence par les attributs (pour des soucis de normes on écrit toujours avec _ le début des variables
    private $_id;
    private $_nom;
    private $_forcePerso;
    private $_degats;
    private $_niveau;
    private $_experience;
    
    // maintenant il va nous falloir nos getter et setter
    // pour rappel un getter est une méthode qui va nous permettre de renvoyer la valeur d'un attribut 
    // tandis qu'un setter est une méthode chargée d'assigner une valeur à un attribut en vérifiant son intégrité   
    
    // pour construire les setter il faut se pencher sur les valeurs possibles pour chaque attribut
    
    // les valeurs possibles d'un identifiant (ID) sera toujours positif et de type (int)
    // les valeurs possibles pour le nom du personnage sera toujours en chaine de caractère (string)
    // les valeurs possibles pour la force du personnage sont des entiers (int) allant de 1-100
    // les valeurs possibles pour les dégats du personnage sont des entiers (int) allant de 0-100
    // les valeurs possibles pour le niveau d'un personnage sont des entiers (int) allant de 1-100
    // les valeurs possible pour l'expérience d'un personnage sont des entiers (int) allant de 1-100
    
    // Un tableau de données doit être passé à la fonction (d'où le prefixe array)
//     public function hydrate(array $donnees){
//         if(isset($donnees['id'])){
//             $this->setId($donnees['id']);
//         }
        
//         if (isset($donnees['nom'])){
//             $this->setNom($donnees['id']);
//         }
        
//         if (isset($donnees['forcePerso'])){
//             $this->setForce($donnees['forcePerso']);
//         }
        
//         if (isset($donnees['degats'])){
//             $this->setDegats($donnees['degats']);
//         }
        
//         if (isset($donnees['niveau'])){
//             $this->setNiveau($donnees['niveau']);
//         }
        
//         if (isset($donnees['experience'])){
//             $this->setExperience($donnees['experience']);
//         }
//     }

    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value){
            // On récupère le nom du setter correspondant a l'attribut
            $method = 'set'.ucfirst($key);
            
            // si le setter correspondant existe
            if (method_exists($this, $method)){
                // on appelle le setter
                $this->$method($value);
            }
        }
    }
    
    // Getters 
    public function id(){
        return $this->_id;
    }
    
    public function nom(){
        return $this->_nom;
    }
    
    public function forcePerso(){
        return $this->_forcePerso;
    }
    
    public function degats(){
        return $this->_degats;
    }
    
    public function niveau(){
        return $this->_niveau;
    }
    
    public function experience(){
        return $this->_experience;
    }
    
    
    // Setters
    public function setId($id){
        // On convertir l'argument en nombre entier 
        // Si c'en était déjà un rien ne changera
        // Sinon la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici)
        
        $id = (int) $id;
        
        // on vérifie ensuite si ce nombre est bien strictement positif
        if ($id > 0){
            // Si c'est le cas c'est tout bon on assigne la valeur à l'attribut correspondant 
            $this->_id = $id;
        }
    }
    
    public function setNom($nom){
        // on vérifie bien qu'il s'agit d'une chaine de caractères
        if (is_string($nom)){
            $this->_nom = $nom;
        }
    }
    
    public function setForce($forcePerso){
        // on convertit l'argument en nombre entier
        $forcePerso = (int) $forcePerso;
        
        // on vérifie ensuite si ce nombre est compris entre 1 et 100
        if ($forcePerso >= 1 && $forcePerso <= 100){
            // si c'est le cas c'est tout bon on assigne la valeur a l'attribut correspondant
            $this->_forcePerso = $forcePerso;
        }
    }
    
    public function setDegats($degats){
        // on convertit l'argument en nombre entier
        $degats = (int) $degats;
        
        // on vérifie ensuite si ce nombre est compris entre 1 et 100
        if ($degats >= 0 && $degats <= 100){
            // si c'est le cas c'est tout bon on assigne la valeur a l'attribut correspondant
            $this->_degats = $degats;
        }
    }
    
    public function setNiveau($niveau){
        // on convertit l'argument en nombre entier
        $niveau = (int) $niveau;
        
        // on vérifie ensuite si ce nombre est compris entre 1 et 100
        if ($niveau >= 1 && $niveau <= 100){
            // si c'est le cas c'est tout bon on assigne la valeur a l'attribut correspondant
            $this->_niveau = $niveau;
        }
    }
    
    public function setExperience($experience){
        // on convertit l'argument en nombre entier
        $experience = (int) $experience;
        
        // on vérifie ensuite si ce nombre est compris entre 1 et 100
        if ($experience >= 1 && $experience <= 100){
            // si c'est le cas c'est tout bon on assigne la valeur a l'attribut correspondant
            $this->_experience = $experience;
        }
    }
}