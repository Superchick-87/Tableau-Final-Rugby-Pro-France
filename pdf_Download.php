
<?php
// URL du fichier PDF à télécharger
$pdf_url = "https://infographie.sudouest.fr/ProductionPdf/TableauFinalChampionsCup_" . $date . ".pdf";

// Chemin où vous souhaitez enregistrer le fichier PDF téléchargé
$destination = getenv("HOME") . "/Desktop/";

// Nom de fichier souhaité pour le PDF téléchargé
$filename = "TableauFinalChampionsCup_" . $date . ".pdf";

// Télécharger le fichier PDF depuis l'URL
$pdf_content = file_get_contents($pdf_url);

// Écrire le contenu du fichier PDF dans le dossier de destination
file_put_contents($destination . $filename, $pdf_content);

echo "<div id='download'>Le fichier PDF a été téléchargé avec succès sur votre bureau.</div>";
?>
