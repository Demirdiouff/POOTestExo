<?php

include ('Personnage.php');

// On crée notre classe (manager) qui va nous permettre de gérer les différents personnages
class PersonnagesManager {
    
    // on crée les attributs la notation se fait avec _ devant la variable.
    private $_db; // instance de PDO

    // un manager doit pouvoir gérer plusieurs fonctionnalités de base : 
    // 1) enregistrer une nouvelle entité
    // 2) modifier une entité
    // 3) supprimer une entité
    // 4) selectionner une entité
    // C'est le fameux CRUD
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function add(Personnage $perso){
        // Préparation de la requête pour ajouter un personnage dans la BDD, va executer une requete ADD
        // On doit assigner des valeurs par le nom, la force, les dégats, l'expérience, et le niveau de personnage
        // execution de la requête 
        
        $q = $this->_db->prepare('INSERT into personnages(nom, forcePerso, degats, niveau, experience) VALUES (:nom, :forcePerso, :degats, :niveau, :experience)');
        $q->bindValue(':nom', $perso->nom());
        $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
        
        $q->execute();
    }
    
    public function delete(Personnage $perso){
        // execute une requête de type DELETE 
        $this->_db->exec('DELETE FROM personnages WHERE id = '.$perso->id());
    }
    
    public function get($id){
        // execute une requête de type SELECT avec une clause WHERE et retourne un objet Personnage
        $id = (int) $id;
        
        $q = $this->_db->query('SELECT id, nom, degats, niveau, experience FROM personnages WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        
        return new Personnage($donnees);
    }
    
    public function getList(){
        // retourne la liste de tous les personnages
        $persos = [];
        
        $q = $this->_db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages ORDER BY nom');
        
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){
            $persos[] = new Personnage($donnees);
        }
        
        return $persos;
    }
    
    public function update(Personnage $perso){
        // prépare une requête de type UPDATE 
        // assignation des valeurs à la requete 
        // execution de la requete
        
        $q = $this->_db->prepare('UPDATE personnages SET forcePerso = :forcePerso, degats = :degats, niveau = :niveau, experience = :experience WHERE id = :id');
        
        $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
        
        $q->execute();
    }
    
    // Setter 
    public function setDb(PDO $db){
        $this->_db = $db;
    }
}


$perso = new Personnage([ 
    'nom' => 'Victor',
    'forcePerso' => '50',
    'degats' => '20',
    'niveau' => '1',
    'experience' => '0'
]);

$db = new PDO('mysql:host=localhost;dbname=CoursPOO', 'root', 'root');
$manager = new PersonnagesManager($db);

$manager->add($perso);

echo 'Le personnage a bien été ajouté';