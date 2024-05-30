<?php
include(dirname(__FILE__) . '/includes/ddc.php');
echo $_POST['ap_sf1'];
/**
 * @renseigne si prolongation à l'issue de la rencontre
 *
 * @param [str] $x
 * @return void
 */
function ap($x) {
    if ($x == 'unchecked') {
        return '';
    }
    if ($x == '(a. p.)') {
        return '(a. p.)';
    }
}


$datae = array(
    "Barrage 1" => array(
        $_POST['lieu_qf1'],
        $_POST['team1_qf1'],
        $_POST['score1_qf1'],
        $_POST['team2_qf1'],
        $_POST['score2_qf1'],
        ap($_POST['ap_qf1'])
    ),
    "Barrage  2" => array(
        $_POST['lieu_qf2'],
        $_POST['team1_qf2'],
        $_POST['score1_qf2'],
        $_POST['team2_qf2'],
        $_POST['score2_qf2'],
        ap($_POST['ap_qf2'])
    ),
    "Demi-finale 1" => array(
        $_POST['lieu_sf1'],
        $_POST['team1_sf1'],
        $_POST['score1_sf1'],
        $_POST['team2_sf1'],
        $_POST['score2_sf1'],
        ap($_POST['ap_sf1'])
    ),
    "Demi-finale 2" => array(
        $_POST['lieu_sf2'],
        $_POST['team1_sf2'],
        $_POST['score1_sf2'],
        $_POST['team2_sf2'],
        $_POST['score2_sf2'],
        ap($_POST['ap_sf2'])
    ),
    "Finale" => array(
        $_POST['lieu_final'],
        $_POST['team1_final'],
        $_POST['score1_final'],
        $_POST['team2_final'],
        $_POST['score2_final'],
        ap($_POST['ap_final'])
    )
);

// Ouvrir ou créer le fichier CSV en mode écriture
$filee = fopen('datas_' . ddc($_POST['competition']) . '.csv', 'w');

// Parcourir chaque élément du tableau et écrire dans le fichier CSV
foreach ($datae as $keye => $valuee) {
    fputcsv($filee, array_merge(array($keye), $valuee));
}

// Fermer le fichier
fclose($filee);

// echo $_POST['competition'];
include(dirname(__FILE__) . '/pdf.php');
// Vérifie si la variable competition existe dans $_GET
