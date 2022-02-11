<?php 
 /**
  * Auteur : Maxime Avranche
  * Créé le 02/02/2022
  * Tous droits réservés
 **/

        /******************MENU*****************\
       /*****************************************\
      /** I - Connexion à la base de données    **\
     /** II - Fonctions principales              **\
    /** III - Fonctions pour la table 'daily'     **\
   /** IV - Fonctions de statistiques              **\
  /** V - Fonctions de configuration                **\
 /*****************************************************\

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

          // Mise à jour d'un créneau
          function updateCreneau($nbr_disponible, $nbr_occupe, $tps_attente, $nbr_clients, $buffer) {
            $updateCreneau = $this->bdd->prepare('UPDATE current SET nbr_disponible = ?, nbr_occupe = ?, tps_attente = ?, nbr_clients = ?, buffer = ? WHERE id = 1');
            $updateCreneau->execute(array($nbr_disponible, $nbr_occupe, $tps_attente, $nbr_clients, $buffer));
          }

          // Récupérer les informations 
          function selectInformation() {
            $selectInformation = $this->bdd->prepare('SELECT * FROM configuration WHERE nom_employe is NOT NULL');
            $selectInformation->execute();
            $resSelectInformation = $selectInformation->fetchAll();
            return $resSelectInformation;
          }

          // Modifier le temps d'attente
          function updateTime($affichage_attente) {
            $updateTime = $this->bdd->prepare('UPDATE current SET tps_attente = ? WHERE id = 1');
            $updateTime->execute(array($affichage_attente));
          }

          // Modification temps d'attente si 0 
          function allDispo($tps) {
            $allDispo = $this->bdd->prepare('UPDATE current SET tps_attente = ? WHERE id = 1');
            $allDispo->execute(array($tps));
          }

          // Break time
          function break($breakTimeDisponible, $breakTimeOccupe) {
            $break = $this->bdd->prepare('UPDATE current SET nbr_disponible = ?, nbr_occupe = ? WHERE id = 1');
            $break->execute(array($breakTimeDisponible, $breakTimeOccupe));

          }

          // Calcul & Affichage du temps d'attente
          function waitingTime($temps) {
            if ($temps > 59) {
              $coef_heure = $temps / 60;
              $heure = floor($temps / 60);
              $minute = ($coef_heure - $heure) * 60;
              $affichage_attente = $heure ."h ". $minute . "min";
            }
            else {
              $affichage_attente = $temps ." min";
            }

            return $affichage_attente;
          }


          /****************************************
           * 
           * FONCTIONS POUR LA TABLE DAILY
           * Utilisation non visible (en background)
           * 
           ***************************************/

          // Sélection des données de la table daily
          function selectDaily() {
            $selectDaily = $this->bdd->prepare('SELECT * FROM daily LIMIT 1');
            $selectDaily->execute();
            $resSelectDaily = $selectDaily->fetch();
            return $resSelectDaily;
          }

          // Addition du nombre de clients traités
          function sumDaily() {
            $sql = "SELECT SUM(total_clients) AS total FROM daily";
            $sumDaily = $this->bdd->prepare($sql);
            $sumDaily->execute();
            $resSumDaily = $sumDaily->fetch();
            return $resSumDaily;
          }

          // Compter le nombre d'employés
          function countDaily() {
            $countDaily = $this->bdd->prepare('SELECT COUNT(id) as id FROM daily');
            $countDaily->execute();
            $resCountDaily = $countDaily->fetch();
            return $resCountDaily;
          }

          // Supprimer les valeurs de la table
          function deleteDaily() {
            $deleteDaily = $this->bdd->prepare('DELETE FROM daily WHERE id_emp IS NOT null');
            $deleteDaily->execute();
          }


          /****************************************
           * 
           * FONCTIONS DE STATISTIQUES
           * Utilisation réccurente
           * 
           ***************************************/

          function insertStats($date, $clients, $employes, $buffer) {
            $insertStats = $this->bdd->prepare('INSERT INTO stats VALUES(0, ?, ?, ?, ?)');
            $insertStats->execute(array($date, $clients, $employes, $buffer));
            return $insertStats;
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

          // Ajouter le prénom d'un employé
          function addName($name) {
            // Création d'un ID
            $id_emp = $this->id_emp($name);
            // Insertion
            $addName = $this->bdd->prepare('INSERT INTO configuration VALUES(0, ?, ?, null, null, null, null, null, null, null, null)');
            $addName->execute(array($id_emp, $name));
            // Afficher sur l'administration le nombre exact d'employé sans modifier les autres valeurs
            $resCountEmployee = $this->countEmployee();
            $total = $resCountEmployee['id'] - 1;
            $this->updateEmploye($total);
          }

          // Mise à jour du nombre d'employé
          function updateEmploye($number) {
            $updateEmploye = $this->bdd->prepare('UPDATE current SET nbr_disponible = ? WHERE id = 1');
            $updateEmploye->execute(array($number));
          }

          // Supprimer un employé
          function deleteEmploye($id_employe) {
            $deleteEmploye = $this->bdd->prepare('DELETE FROM configuration WHERE id = ?');
            $deleteEmploye->execute(array($id_employe));

            // Récupération des données nécessaires
            $resSelectDatabase = $this->selectDatabase();
            // Retirer un employé sans modifier les autres valeurs
            $modifyDisponible = $this->bdd->prepare('UPDATE current SET nbr_disponible = ? WHERE id = 1');
            $modifyDisponible->execute(array($resSelectDatabase['nbr_disponible'] - 1));
          }


          // Compter nombre d'employés
          function countEmployee() {
            $countEmployee = $this->bdd->prepare('SELECT COUNT(*) as id FROM configuration');
            $countEmployee->execute();
            $resCountEmployee = $countEmployee->fetch();
            return $resCountEmployee;
          }





          // Créer un id_emp
          function id_emp($prenom) {
            // Sécurité
            $prenom = htmlspecialchars($prenom);
            // Création de l'identifiant
            $prenom = strtoupper($prenom);
            $prenom = substr($prenom, 0, 2);
            $id_emp = $prenom.rand(1000, 9999);
            return $id_emp;
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