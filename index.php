<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de rugby - Quarts de finale à la finale</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>

</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background-image: radial-gradient(currentColor .5px, transparent .5px);
        background-size: calc(10* .5px) calc(10* .5px);
        font-family: 'Roboto', serif;

    }

    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        text-align: center;
        padding: 20px;
    }

    .center {
        text-align: center;
    }

    .quarter-final {
        /* width: 45%; */
        padding: 10px;
        border: 1px solid black;
        margin-bottom: 10px;
    }

    .semi-final {
        /* width: 100%; */
        padding: 10px;
        border: 1px solid black;
        margin-bottom: 10px;
    }

    .final {
        width: max-content;
        padding: 10px;
        border: 1px solid black;
        margin-bottom: 10px;
        margin: 0px auto;

    }

    .lieu {
        width: 98%;
        margin: 5px 0px;
    }

    .equipe {
        width: 130px;
    }

    .equipe,
    .score {
        font-size: 1.1em;
    }

    input[type="number"] {
        width: 50px;
    }

    input[type="checkbox"] {
        width: 17px;
    }

    input {
        height: 20px;
        padding-left: 3px;
    }

    h1,
    h3 {
        margin-bottom: 7px;
        text-align: center;
    }

    p {
        font-style: italic;
    }

    .spaceLeft {
        margin-left: 7px;

    }

    .ap {
        display: flex;
        margin: 10px 0px 0px 36px;
    }

    img {
        height: 30px;
        width: 30px;
        position: relative;
        top: 10px;
    }

    #loader {
        /* margin: 0px auto;
        width: 5em; */
    }

    button {
        width: 150px;
        height: 30px;
        text-align: center;
        background-color: #669bbc;
        border: none;
        color: #FFF;
        font-size: 15px;
        cursor: pointer;
        margin: 0px auto 15px auto;
    }

    button:hover {
        background-color: #4a7088;
    }

    .center {
        text-align: center;
    }

    .loader {
        margin: 0px auto;
        width: 5em;
    }

    /* Normal Usage */
    .loader:before {
        transform: rotateX(60deg) rotateY(45deg) rotateZ(45deg);
        animation: 750ms rotateBefore infinite linear reverse;
    }

    .loader:after {
        transform: rotateX(240deg) rotateY(45deg) rotateZ(45deg);
        animation: 750ms rotateAfter infinite linear;
    }

    .loader:before,
    .loader:after {
        box-sizing: border-box;
        content: '';
        display: block;
        position: absolute;
        /* margin-top: -5em;
        margin-left: -5em; */
        margin: 0px auto;
        width: 5em;
        height: 5em;
        transform-style: preserve-3d;
        transform-origin: 50%;
        transform: rotateY(50%);
        perspective-origin: 50% 50%;
        perspective: 340px;
        background-size: 5em 5em;
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjI2NnB4IiBoZWlnaHQ9IjI5N3B4IiB2aWV3Qm94PSIwIDAgMjY2IDI5NyIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4bWxuczpza2V0Y2g9Imh0dHA6Ly93d3cuYm9oZW1pYW5jb2RpbmcuY29tL3NrZXRjaC9ucyI+CiAgICA8dGl0bGU+c3Bpbm5lcjwvdGl0bGU+CiAgICA8ZGVzY3JpcHRpb24+Q3JlYXRlZCB3aXRoIFNrZXRjaCAoaHR0cDovL3d3dy5ib2hlbWlhbmNvZGluZy5jb20vc2tldGNoKTwvZGVzY3JpcHRpb24+CiAgICA8ZGVmcz48L2RlZnM+CiAgICA8ZyBpZD0iUGFnZS0xIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIiBza2V0Y2g6dHlwZT0iTVNQYWdlIj4KICAgICAgICA8cGF0aCBkPSJNMTcxLjUwNzgxMywzLjI1MDAwMDM4IEMyMjYuMjA4MTgzLDEyLjg1NzcxMTEgMjk3LjExMjcyMiw3MS40OTEyODIzIDI1MC44OTU1OTksMTA4LjQxMDE1NSBDMjE2LjU4MjAyNCwxMzUuODIwMzEgMTg2LjUyODQwNSw5Ny4wNjI0OTY0IDE1Ni44MDA3NzQsODUuNzczNDM0NiBDMTI3LjA3MzE0Myw3NC40ODQzNzIxIDc2Ljg4ODQ2MzIsODQuMjE2MTQ2MiA2MC4xMjg5MDY1LDEwOC40MTAxNTMgQy0xNS45ODA0Njg1LDIxOC4yODEyNDcgMTQ1LjI3NzM0NCwyOTYuNjY3OTY4IDE0NS4yNzczNDQsMjk2LjY2Nzk2OCBDMTQ1LjI3NzM0NCwyOTYuNjY3OTY4IC0yNS40NDkyMTg3LDI1Ny4yNDIxOTggMy4zOTg0Mzc1LDEwOC40MTAxNTUgQzE2LjMwNzA2NjEsNDEuODExNDE3NCA4NC43Mjc1ODI5LC0xMS45OTIyOTg1IDE3MS41MDc4MTMsMy4yNTAwMDAzOCBaIiBpZD0iUGF0aC0xIiBmaWxsPSIjMDAwMDAwIiBza2V0Y2g6dHlwZT0iTVNTaGFwZUdyb3VwIj48L3BhdGg+CiAgICA8L2c+Cjwvc3ZnPg==);
    }

    /* sitNSpin.less */
    @keyframes rotateBefore {
        from {
            transform: rotateX(60deg) rotateY(45deg) rotateZ(0deg);
        }

        to {
            transform: rotateX(60deg) rotateY(45deg) rotateZ(-360deg);
        }
    }

    @keyframes rotateAfter {
        from {
            transform: rotateX(240deg) rotateY(45deg) rotateZ(0deg);
        }

        to {
            transform: rotateX(240deg) rotateY(45deg) rotateZ(360deg);
        }
    }
</style>
<?php
include(dirname(__FILE__) . '/includes/ddc.php');
$_GET['competition'];
$competition = $_GET['competition'];
?>


<body>
    <div class="center">
        <img src="images/<?php echo ddc($competition); ?>.png" style="width: 110px; height: auto;">
    </div>
    </br>
    <h1>Tableau final</h1>
    <div class="container">
        <input type="text" id="competition" value='<?php echo $competition; ?>' style="display:none;">
        <div>
            <div class="quarter-final">
                <h3>Barrage 1</h3>
                <input type="text" id="lieu_qf1" class="lieu">
                <br>
                <img id="team1_qf1-logo" alt="">
                <input type="text" id="team1_qf1" placeholder="Équipe 1" class="equipe">
                <input type="number" id="score1_qf1" placeholder="" class="score">
                <br>
                <img id="team2_qf1-logo" alt="">
                <input type="text" id="team2_qf1" placeholder="Équipe 2" class="equipe">
                <input type="number" id="score2_qf1" placeholder="" class="score">
                <br>
                <div class="ap">
                    <input type="checkbox" name="ap_qf1" id="ap_qf1" value="(a. p.)">
                    <p class="spaceLeft">Cocher pour (a. p.)</p>
                </div>
            </div>
        </div>
        <div class="semi-final">
            <h3>Demi-finale 1</h3>
            <input type="text" id="lieu_sf1" class="lieu">
            <br>
            <img id="team1_sf1-logo" alt="">
            <input type="text" id="team1_sf1" placeholder="Équipe 1" class="equipe">
            <input type="number" id="score1_sf1" placeholder="" class="score">
            <br>
            <img id="team2_sf1-logo" alt="">
            <input type="text" id="team2_sf1" placeholder="Équipe 2" class="equipe">
            <input type="number" id="score2_sf1" placeholder="" class="score">
            <br>
            <div class="ap">
                <input type="checkbox" name="ap_sf1" id="ap_sf1" value="(a. p.)">
                <p class="spaceLeft">Cocher pour (a. p.)</p>
            </div>
        </div>
        <div class="semi-final">
            <h3>Demi-finale 2</h3>
            <input type="text" id="lieu_sf2" class="lieu">
            <br>
            <img id="team1_sf2-logo" alt="">
            <input type="text" id="team1_sf2" placeholder="Équipe 1" class="equipe">
            <input type="number" id="score1_sf2" placeholder="" class="score">
            <br>
            <img id="team2_sf2-logo" alt="">
            <input type="text" id="team2_sf2" placeholder="Équipe 2" class="equipe">
            <input type="number" id="score2_sf2" placeholder="" class="score">
            <br>
            <div class="ap">
                <input type="checkbox" name="ap_sf2" id="ap_sf2" value="(a. p.)">
                <p class="spaceLeft">Cocher pour (a. p.)</p>
            </div>
        </div>
        <div>
            <div class="quarter-final">
                <h3>Barrage 2</h3>
                <input type="text" id="lieu_qf2" class="lieu">
                <br>
                <img id="team1_qf2-logo" alt="">
                <input type="text" id="team1_qf2" placeholder="Équipe 1" class="equipe">
                <input type="number" id="score1_qf2" placeholder="" class="score">
                <br>
                <img id="team2_qf2-logo" alt="">
                <input type="text" id="team2_qf2" placeholder="Équipe 2" class="equipe">
                <input type="number" id="score2_qf2" placeholder="" class="score">
                <br>
                <div class="ap">
                    <input type="checkbox" name="ap_qf2" id="ap_qf2" value="(a. p.)">
                    <p class="spaceLeft">Cocher pour (a. p.)</p>
                </div>
            </div>
        </div>
    </div>
    <div class="final">
        <h3>Finale</h3>
        <input type="text" id="lieu_final" class="lieu">
        <br>
        <img id="team1_final-logo" alt="">
        <input type="text" id="team1_final" readonly placeholder="Équipe 1" class="equipe">
        <input type="number" id="score1_final" placeholder="" class="score">
        <br>
        <img id="team2_final-logo" alt="">
        <input type="text" id="team2_final" readonly placeholder="Équipe 2" class="equipe">
        <input type="number" id="score2_final" placeholder="" class="score">
        <br>
        <div class="ap">
            <input type="checkbox" name="ap_final" id="ap_final" value="(a. p.)">
            <p class="spaceLeft">Cocher pour (a. p.)</p>
        </div>
    </div>
    <div class="center">
        </br>
        <button type="button" id="submitBtn" onclick="sendData()">Valider</button>

        <legend id="legend" style="display: block;"> - Cliquer sur valider pour générer l'infographie - </legend>

        <div id="loader" style="display: none;">
            <legend> - Génération de l'infographie - </legend>
            <div class="loader">
            </div>
        </div>
        </br>
        <div id="txtHint"></div>
    </div>

    <script>
        function sendData() {
            // document.getElementById("download").style.display = "none";
            // Afficher le loader seulement si #txtHint est vide
            if (document.getElementById("txtHint").innerHTML.trim() === "") {
                document.getElementById("loader").style.display = "block";
                document.getElementById("legend").style.display = "none";
            } else {
                document.getElementById("download").style.display = "none";
                document.getElementById("loader").style.display = "block";
            }
            // Créer un objet FormData pour collecter toutes les données des champs d'entrée
            var formData = new FormData();

            // Sélectionner tous les champs d'entrée
            var inputs = document.querySelectorAll('input');

            // Parcourir tous les champs d'entrée
            inputs.forEach(function(input) {
                // Vérifier si l'élément est un checkbox
                if (input.type === 'checkbox') {
                    // Ajouter l'état du checkbox au formData
                    formData.append(input.id, input.checked ? '(a. p.)' : 'unchecked');
                } else {
                    // Pour d'autres types d'input, ajoutez leur valeur au formData
                    formData.append(input.id, input.value);
                }
            });

            // Créer un objet XMLHttpRequest
            var xhttp = new XMLHttpRequest();

            // Définir ce qu'il se passe lorsqu'une réponse est reçue
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Mettre à jour le contenu de l'élément avec la réponse
                    document.getElementById("txtHint").innerHTML = this.responseText;
                    // Masquer une fois que la réponse est reçue
                    document.getElementById("loader").style.display = "none";
                    // document.getElementById("download").style.display = "block";

                }
            };

            // Ouvrir une connexion vers le fichier done.php
            xhttp.open("POST", "done.php", true);
            // Envoyer le formData
            xhttp.send(formData);
        }
    </script>
    <script>
        window.onload = function() {

            // Charger le fichier CSV
            competition = document.getElementById(`competition`).value;
            console.log(camelize(competition));
            fetch('datas_' + camelize(competition) + '.csv')
                .then(response => response.text())
                .then(data => {
                    // Utiliser PapaParse pour parser le CSV
                    const parsedData = Papa.parse(data, {
                        header: false
                    });

                    // Accéder aux données analysées
                    const rows = parsedData.data;


                    // Finale
                    const finaleColumns = rows[4];
                    if (finaleColumns && finaleColumns.length >= 4) {
                        const lieuFinal = finaleColumns[1]; // Ajustement de l'index pour le lieu
                        const equipe1Final = finaleColumns[2]; // Ajustement de l'index pour la première équipe
                        const score1Final = finaleColumns[3]; // Ajustement de l'index pour le premier score
                        const equipe2Final = finaleColumns[4]; // Ajustement de l'index pour la deuxième équipe
                        const score2Final = finaleColumns[5]; // Ajustement de l'index pour le deuxième score
                        const apF = finaleColumns[6]; // Ajustement de l'index pour le deuxième score


                        // Mettre à jour les valeurs des inputs pour la finale
                        document.getElementById(`lieu_final`).value = lieuFinal || "";
                        document.getElementById(`team1_final`).value = equipe1Final || "";
                        document.getElementById(`score1_final`).value = score1Final || "";
                        document.getElementById(`team2_final`).value = equipe2Final || "";
                        document.getElementById(`score2_final`).value = score2Final || "";
                        // Mettre à jour les valeurs des inputs ap
                        document.getElementById(`ap_final`).checked = apF;

                        // Mettre à jour les images des équipes pour la finale
                        const imgSrc1Final = equipe1Final ? `images/Rugby/${camelize(equipe1Final)}.png` : 'images/Rugby/xx.png';
                        const imgSrc2Final = equipe2Final ? `images/Rugby/${camelize(equipe2Final)}.png` : 'images/Rugby/xx.png';

                        document.getElementById(`team1_final-logo`).src = imgSrc1Final;
                        document.getElementById(`team2_final-logo`).src = imgSrc2Final;


                    } else {
                        console.error("Données de la finale non disponibles ou incomplètes.");
                    }

                    // Quarts de finale
                    for (let i = 0; i < 2; i++) {
                        const columns = rows[i];
                        const lieuQF = columns[1];
                        const equipe1QF = columns[2];
                        const score1QF = columns[3];
                        const equipe2QF = columns[4];
                        const score2QF = columns[5];
                        const apQF = columns[6];

                        // Mettre à jour les valeurs des inputs pour les quarts de finale
                        document.getElementById(`lieu_qf${i + 1}`).value = lieuQF;
                        document.getElementById(`team1_qf${i + 1}`).value = equipe1QF;
                        document.getElementById(`score1_qf${i + 1}`).value = score1QF;
                        document.getElementById(`team2_qf${i + 1}`).value = equipe2QF;
                        document.getElementById(`score2_qf${i + 1}`).value = score2QF;
                        // Mettre à jour les valeurs des inputs ap
                        document.getElementById(`ap_qf${i + 1}`).checked = apQF;

                        // Mettre à jour les images des équipes pour les quarts de finale
                        // const imgSrc1QF = equipe1QF ? `images/Rugby/${camelize(equipe1QF)}.png` : 'images/Rugby/xx.png';
                        // const imgSrc2QF = equipe2QF ? `images/Rugby/${camelize(equipe2QF)}.png` : 'images/Rugby/xx.png';

                        // document.getElementById(`team1_qf${i + 1}-logo`).src = imgSrc1QF;
                        // document.getElementById(`team2_qf${i + 1}-logo`).src = imgSrc2QF;
                    }

                    // Demi-finales
                    for (let i = 2; i < rows.length; i++) {
                        const columns = rows[i];
                        const lieuSF = columns[1];
                        const equipe1SF = columns[2];
                        const score1SF = columns[3];
                        const equipe2SF = columns[4];
                        const score2SF = columns[5];
                        const apSF = columns[6];

                        // Mettre à jour les valeurs des inputs pour les demi-finales et la finale
                        document.getElementById(`lieu_sf${i - 1}`).value = lieuSF;
                        document.getElementById(`team1_sf${i - 1}`).value = equipe1SF;
                        document.getElementById(`score1_sf${i - 1}`).value = score1SF;
                        document.getElementById(`team2_sf${i - 1}`).value = equipe2SF;
                        document.getElementById(`score2_sf${i - 1}`).value = score2SF;
                        // Mettre à jour les valeurs des inputs ap
                        document.getElementById(`ap_sf${i - 1}`).checked = apSF;

                        // Mettre à jour les images des équipes pour les demi-finales et la finale
                        const imgSrc1SF = equipe1SF ? `images/Rugby/${camelize(equipe1SF)}.png` : 'images/Rugby/xx.png';
                        const imgSrc2SF = equipe2SF ? `images/Rugby/${camelize(equipe2SF)}.png` : 'images/Rugby/xx.png';

                        document.getElementById(`team1_sf${i - 1}-logo`).src = imgSrc1SF;
                        document.getElementById(`team2_sf${i - 1}-logo`).src = imgSrc2SF;
                        updateFinal();
                        updateSemiFinals();
                    }

                })
                .catch(error => console.log('Erreur de chargement du fichier CSV :', error));
        };
    </script>
    <script src="js/camelize.js"></script>
    <script>
        const qfElements = document.querySelectorAll('.quarter-final');

        // Ajoutez des écouteurs d'événements pour les quarts de finale
        qfElements.forEach(qfElement => {
            const scoreInputs = qfElement.querySelectorAll('.score');
            scoreInputs.forEach(scoreInput => {
                scoreInput.addEventListener('change', updateSemiFinals);
                scoreInput.addEventListener('change', updateFinal); // Ajout de l'écouteur pour la finale
            });

            // Mettez à jour les images des équipes pour les quarts de finale
            const teamInputs = qfElement.querySelectorAll('.equipe');
            teamInputs.forEach(teamInput => {
                teamInput.addEventListener('change', updateTeamImage);
            });
        });

        // Fonction pour mettre à jour les demi-finales en fonction des scores des quarts de finale
        function updateSemiFinals() {
            const score1_sf1 = document.getElementById('score1_sf1');
            const score2_sf1 = document.getElementById('score2_sf1');
            const score1_sf2 = document.getElementById('score1_sf2');
            const score2_sf2 = document.getElementById('score2_sf2');

            const team1_sf1 = document.getElementById('team1_sf1');
            const team2_sf1 = document.getElementById('team2_sf1');
            const team1_sf2 = document.getElementById('team1_sf2');
            const team2_sf2 = document.getElementById('team2_sf2');

            const score1_qf1 = Number(document.getElementById('score1_qf1').value);
            const score2_qf1 = Number(document.getElementById('score2_qf1').value);
            const score1_qf2 = Number(document.getElementById('score1_qf2').value);
            const score2_qf2 = Number(document.getElementById('score2_qf2').value);

            // Vérifier si tous les scores des quarts de finale sont renseignés
            if (!isNaN(score1_qf1) && !isNaN(score2_qf1)) {
                // Mettre à jour les demi-finales 1

                if (score1_qf1 > score2_qf1) {
                    team2_sf1.value = document.getElementById('team1_qf1').value;
                    updateTeamImage('team2_sf1');
                } else {
                    team2_sf1.value = document.getElementById('team2_qf1').value;
                    updateTeamImage('team2_sf1');
                }
                if (score1_qf1 == '' || score2_qf1 == '') {
                    team2_sf1.value = '';
                    updateTeamImage('team2_sf1');
                }
            }

            // Mettre à jour les demi-finales 2
            if (!isNaN(score1_qf2) && !isNaN(score2_qf2)) {
                if (score1_qf2 > score2_qf2) {
                    team2_sf2.value = document.getElementById('team1_qf2').value;
                    updateTeamImage('team2_sf2');
                } else {
                    team2_sf2.value = document.getElementById('team2_qf2').value;
                    updateTeamImage('team2_sf2');
                }
                if (score1_qf2 == '' || score2_qf2 == '') {
                    team2_sf2.value = '';
                    updateTeamImage('team2_sf2');
                }
            }
        }

        // Récupérer les éléments des scores des demi-finales
        const scoreInputs_sf1 = document.querySelectorAll('.semi-final #score1_sf1, .semi-final #score2_sf1');
        const scoreInputs_sf2 = document.querySelectorAll('.semi-final #score1_sf2, .semi-final #score2_sf2');

        // Ajouter des écouteurs d'événements pour les scores des demi-finales
        scoreInputs_sf1.forEach(scoreInput => {
            scoreInput.addEventListener('change', updateFinalIfAllScoresFilled);
        });

        scoreInputs_sf2.forEach(scoreInput => {
            scoreInput.addEventListener('change', updateFinalIfAllScoresFilled);
        });

        // Fonction pour mettre à jour la finale uniquement si tous les scores des demi-finales sont remplis
        function updateFinalIfAllScoresFilled() {
            // Récupérer les scores des demi-finales
            const score1_sf1 = Number(document.getElementById('score1_sf1').value);
            const score2_sf1 = Number(document.getElementById('score2_sf1').value);
            const score1_sf2 = Number(document.getElementById('score1_sf2').value);
            const score2_sf2 = Number(document.getElementById('score2_sf2').value);

            // Vérifier si tous les scores des demi-finales sont remplis
            if (!isNaN(score1_sf1) && !isNaN(score2_sf1) && !isNaN(score1_sf2) && !isNaN(score2_sf2)) {
                // Appeler la fonction pour mettre à jour la finale
                updateFinal();

            }


        }

        // Fonction pour mettre à jour la finale en fonction des scores des demi-finales
        function updateFinal() {
            // Récupérez les éléments des scores des demi-finales
            const score1_sf1 = Number(document.getElementById('score1_sf1').value);
            const score2_sf1 = Number(document.getElementById('score2_sf1').value);
            const score1_sf2 = Number(document.getElementById('score1_sf2').value);
            const score2_sf2 = Number(document.getElementById('score2_sf2').value);

            // Récupérez les éléments des équipes des demi-finales
            const team1_sf1 = document.getElementById('team1_sf1').value;
            const team2_sf1 = document.getElementById('team2_sf1').value;
            const team1_sf2 = document.getElementById('team1_sf2').value;
            const team2_sf2 = document.getElementById('team2_sf2').value;

            // Sélectionnez l'équipe gagnante de chaque demi-finale en fonction du score le plus élevé
            const winner_sf1 = (score1_sf1 > score2_sf1) ? team1_sf1 : team2_sf1;
            const winner_sf2 = (score1_sf2 > score2_sf2) ? team1_sf2 : team2_sf2;

            // Mettez à jour les équipes dans la finale
            document.getElementById('team1_final').value = winner_sf1;
            document.getElementById('team2_final').value = winner_sf2;

            if (score1_sf1 == '' || score2_sf1 == '') {
                document.getElementById('team1_final').value = '';
            }
            if (score1_sf2 == '' || score2_sf2 == '') {
                document.getElementById('team2_final').value = '';
            }
            updateTeamImage();
        }

        function updateTeamImage() {

            // Chemin relatif du dossier contenant les images
            const imagePath = 'images/Rugby/';

            // Image par défaut
            const defaultImage = 'xx.png';

            // Mettre à jour les images des quarts de finale
            const team1_qf1_logo = document.getElementById('team1_qf1-logo');
            const team2_qf1_logo = document.getElementById('team2_qf1-logo');
            const team1_qf2_logo = document.getElementById('team1_qf2-logo');
            const team2_qf2_logo = document.getElementById('team2_qf2-logo');

            team1_qf1_logo.src = getImagePath(document.getElementById('team1_qf1').value, imagePath, defaultImage);
            team2_qf1_logo.src = getImagePath(document.getElementById('team2_qf1').value, imagePath, defaultImage);
            team1_qf2_logo.src = getImagePath(document.getElementById('team1_qf2').value, imagePath, defaultImage);
            team2_qf2_logo.src = getImagePath(document.getElementById('team2_qf2').value, imagePath, defaultImage);

            // Mettre à jour les images des demi-finales
            const team1_sf1_logo = document.getElementById('team1_sf1-logo');
            const team2_sf1_logo = document.getElementById('team2_sf1-logo');
            const team1_sf2_logo = document.getElementById('team1_sf2-logo');
            const team2_sf2_logo = document.getElementById('team2_sf2-logo');

            team1_sf1_logo.src = getImagePath(document.getElementById('team1_sf1').value, imagePath, defaultImage);
            team2_sf1_logo.src = getImagePath(document.getElementById('team2_sf1').value, imagePath, defaultImage);
            team1_sf2_logo.src = getImagePath(document.getElementById('team1_sf2').value, imagePath, defaultImage);
            team2_sf2_logo.src = getImagePath(document.getElementById('team2_sf2').value, imagePath, defaultImage);

            // Mettre à jour les images des équipes pour la finale
            const team1_final_logo = document.getElementById('team1_final-logo');
            const team2_final_logo = document.getElementById('team2_final-logo');

            team1_final_logo.src = getImagePath(document.getElementById('team1_final').value, imagePath, defaultImage);
            team2_final_logo.src = getImagePath(document.getElementById('team2_final').value, imagePath, defaultImage);

        }
        // Fonction pour obtenir le chemin de l'image en vérifiant si elle existe
        function getImagePath(teamName, imagePath, defaultImage) {
            // Vérifier si le nom de l'équipe est vide ou nul
            if (!teamName || teamName.trim() === '') {
                return imagePath + defaultImage;
            }

            const cleanedTeamName = camelize(teamName);
            const imageSrc = imagePath + cleanedTeamName + '.png';

            // Vérifier si l'image existe, sinon, retourner l'image par défaut
            const img = new Image();
            img.src = imageSrc;
            if (img.width === 0 || img.height === 0) {
                return imagePath + defaultImage;
            }
            return imageSrc;
        }

        // Fonction pour mettre à jour l'image d'un input
        function updateTeamImageFromInput(inputId) {
            const input = document.getElementById(inputId);
            if (!input) return;

            const logoId = inputId + '-logo';
            const logoImg = document.getElementById(logoId);
            if (!logoImg) return;

            const teamName = input.value.trim();
            const imgSrc = teamName ? `images/Rugby/${camelize(teamName)}.png` : 'images/Rugby/xx.png';
            logoImg.src = imgSrc;
        }

        // Ajouter l'événement à tous les inputs de classe .equipe
        document.querySelectorAll('input.equipe').forEach(input => {
            input.addEventListener('blur', () => {
                updateTeamImageFromInput(input.id);
            });
        });
    </script>

</body>

</html>