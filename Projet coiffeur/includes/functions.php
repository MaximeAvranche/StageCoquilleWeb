<?php 
 /**
  * Auteur : Maxime Avranche
  * Créé le 02/02/2022
  * Tous droits réservés
 **/


/* Connexion base de données */
  class ConnexionBase
      {
        private $bdd;
        
            public function __construct()
            {
              // On récupère l'accès (nouvelle connexion)
              $this->bdd = new PDO('mysql:host=localhost;dbname=chronocoiffure;charset=utf8', 'root', '');
            }

          /*********************************
           * 
           * FONCTIONS PRINCIPALES 
           * Utilisation sur la page index 
           * 
           ********************************/

          // Récupérer les informations
          function selectDatabase() {
            $selectDatabase = $this->bdd->prepare('SELECT * FROM current WHERE id = 1');
            $selectDatabase->execute();
            $resSelectDatabase = $selectDatabase->fetch();
            return $resSelectDatabase;
          }

          // Modifier nombre de clients
          function addCustomer($nbr_clients) {
            $addCustomer = $this->bdd->prepare('UPDATE current SET nbr_clients = ? WHERE id = 1');
            $addCustomer->execute(array($nbr_clients));
          }

          // Disponibilité d'un employé
          function addEmploye($nbr_disponible, $nbr_occupe) {
            $addEmploye = $this->bdd->prepare('UPDATE current SET nbr_disponible = ?, nbr_occupe = ? WHERE id = 1');
            $addEmploye->execute(array($nbr_disponible, $nbr_occupe));
          }

          // Mise à jour d'un jour
          function updateCreneau($nbr_disponible, $nbr_occupe, $tps_attente, $nbr_clients) {
            $updateCreneau = $this->bdd->prepare('UPDATE current SET nbr_disponible = ?, nbr_occupe = ?, tps_attente = ?, nbr_clients = ? WHERE id = 1');
            $updateCreneau->execute(array($nbr_disponible, $nbr_occupe, $tps_attente, $nbr_clients));
            }


          /****************************************
           * 
           * FONCTIONS DE CONFIGURATION
           * Utilisation sur la page configuration
           * 
           ***************************************/

          // Accéder aux données de configuration
          function selectConfiguration() {
            $selectConfiguration = $this->bdd->prepare('SELECT * FROM configuration WHERE id = 1');
            $selectConfiguration->execute();
            $resSelectConfiguration = $selectConfiguration->fetch();
            return $resSelectConfiguration;
          }

          /*// Création d'un jeu de données
          function existData() {
              $insertConfiguration = $this->bdd->prepare('INSERT INTO configuration VALUES(0, ?, ?, ?, ?)');
              $insertConfiguration->execute(array(null, null, null, null));
          }*/
          

          // Modifier le nombre d'employés
          function updateValues($set_value, $value) {
            $updateValues = $this->bdd->prepare('UPDATE configuration SET '.$set_value.' WHERE id = 1');
            $updateValues->execute(array($value));
            // Met à jour le nombre d'employé et initialise à 0
            if ($set_value == "nbr_employe = ?") {
              $nbr_employe = $this->addEmploye($value, 0);
            }
          }



            /** FONCTIONS A VENIR **/
            /*// Création des créneaux
          function createCreneau($day, $nbr_employe, $tps_attente, $buffer) {
            // Appelle de la fonction pour créer un code unique
            $id_modele = $this->createIdmod(6);
            // Insertion BDD
            $createRdv = $this->bdd->prepare('INSERT INTO current VALUES(0, ?, ?, ?, ?, null, ?)');
            $createRdv->execute(array($day, time(), $nbr_employe, $tps_attente, $id_modele));
          }
           // Création d'un code unique
          function createIdmod($length) {
            $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $id_mod = '';
            for($i = 0; $i<$length; $i++) {
              $id_mod .= $chars[rand(0, strlen($chars)-1)];
            }
            $id_modef = $id_mod + date("YmdHis");
            return $id_modef;
           
          }
          */
      }



?>