<?php 
// Appel des fonctions et récupération des données
  include 'functions.php';
   $db = new ConnexionBase;
   $resSelectDatabase = $db->selectDatabase();
   $resSelectConfiguration = $db->selectConfiguration();
   $resSelectInformation = $db->selectInformation();
   $resCountEmployee = $db->countEmployee();
   $resCountDaily = $db->countDaily();
   $resSelectDaily = $db->selectDaily();

   // Définition des variables
   $employe_total = $resSelectDatabase['nbr_disponible'] + $resSelectDatabase['nbr_occupe'];
   $employe_total = 1 / $employe_total;
   $clients = $resSelectDatabase['nbr_clients'];
   $temps_moyen = $resSelectConfiguration['tps_moyen'];
   $nbr_employe_total = $resCountEmployee['id'] - 1;

   // Prise en charge d'un client
   $new_disponible = $resSelectDatabase['nbr_disponible'] - 1;
   $new_clients = $resSelectDatabase['nbr_clients'] - 1;
   // Mise à jour d'un créneau
   $new_occupe = $resSelectDatabase['nbr_occupe'] + 1;
   $new_attente = $resSelectDatabase['tps_attente'] + 30;
   // Libération d'un employé
   $employeOccupe = $resSelectDatabase['nbr_occupe'];
   $clcDisponible = $resSelectDatabase['nbr_disponible'] + 1;
   $clcOccupe = $resSelectDatabase['nbr_occupe'] - 1;



// Réinitialiser valeurs de tests
   if(isset($_POST['reinitialiser'])) {
    $updateCreneau = $db->updateCreneau($nbr_employe_total, 0, 0, 3);
    header('Location: index.php');
   }

   // Mettre à jour le nombre de clients
   if (isset($_POST['action']) AND $_POST['action'] == "majClients") {
    $maj = $db->addCustomer($_POST['nbr_clients']);
   }

   // Prise en charge d'un client
   if (isset($_POST['prisencharge'])) {
    // Bloquer les valeurs négatives
     if ($resSelectDatabase['nbr_clients'] == 0 OR $resSelectDatabase['nbr_disponible'] == 0) {
      header('Location: index.php');  
     }
     else {
      // Employés supérieurs aux clients
      if ($resSelectDatabase['nbr_disponible'] >= $resSelectDatabase['nbr_client']) {
        $new_occupe = $resSelectDatabase['nbr_occupe'] + 1;
        $updateCreneau = $db->updateCreneau($new_disponible, $new_occupe, $resSelectDatabase['tps_attente'], $new_clients);
        header('Location: index.php');
      }
      // Employés inférieurs aux clients
      else if ($resSelectDatabase['nbr_disponible'] < $resSelectDatabase['nbr_client']) {
        $updateCreneau = $db->updateCreneau($new_disponible, $new_attente, $new_clients);
        header('Location: index.php');
      }
    }
   }

   // Prestation terminée
   if (isset($_POST['terminee'])) {
      // Bloquer les valeurs négatives
      if ($resSelectDatabase['nbr_occupe'] == 0) {
        header('Location: index.php');
      }
        else {
          $addEmploye = $db->addEmploye($clcDisponible, $clcOccupe);
          header('Location: index.php');
        }
   }


   // Calcul temps d'attente
   if ($resSelectDatabase['nbr_clients'] <= $resSelectDatabase['nbr_disponible']) {
    $affichage_attente = 0;
    $db->updateTime($affichage_attente);
   }
   // Les employés ne sont pas disponibles - Des clients attendent
   else {
    // Temps
    $temps = (($temps_moyen * $clients) - ($employe_total * $temps_moyen)) + ($temps_moyen * $employe_total);
    $db->updateTime($temps);
    $affichage_attente = $db->waitingTime($temps);
   }

   // Temps de pause
   if (isset($_POST['break'])) {
    $breakTimeDisponible = $resSelectDatabase['nbr_disponible'] - 1;
    $breakTimeOccupe = $resSelectDatabase['nbr_occupe'] + 1;
    $db->break($breakTimeDisponible, $breakTimeOccupe);
    header('Location: index.php');
   }



   /**
    * 
    * Modifications de 'Daily'
    *  
    **/
$resSumDaily = $db->sumDaily();
   // Btn de clôture pressé
   if (isset($_POST['cloturer'])) {
    // Variables
    $date = $resSelectDaily['date'];
    $clients = $resSumDaily['total'];
    $employes = $resCountDaily['id'];
    $buffer = $resSelectDatabase['buffer'];
    // Envoie des données
    $db->insertStats($date, $clients, $employes, $buffer);
    // Remettre à 0 le buffer
    $db->updateCreneau($nbr_employe_total, 0, 0, 0);
    // Supprimer les données de 'daily'
    header('Location: index.php');
   }




   /*if($resSelectDatabase['date'] == date('Y-m-d')) {
      // Variables à stockers
      $total_clients = $resSelectDatabase['buffer'];
      $employes = array('Maxime', 'Steven');

      $db->insertStats($date_current, $total_clients, $employes_presents);
      header('Location: index.php');
   }*/
?>