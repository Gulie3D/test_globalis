<?php
function foo($intervals) 
{
    // Si la liste d'intervalles est vide, retourner une liste vide
    if (empty($intervals)) {
        return [];
    }

    // Trier les intervalles par leur début
    usort($intervals, function($a, $b) 
    {
        return $a[0] - $b[0];
    });

    $result = []; // Liste pour stocker les intervalles fusionnés
    $current = $intervals[0]; // Premier intervalle

    // Parcourir les intervalles
    foreach ($intervals as $interval) 
    { 
        // Si les intervalles se chevauchent ou se touchent, les fusionner
        if ($interval[0] <= $current[1]) 
        {
            $current[1] = max($current[1], $interval[1]);
        } else {
            // Sinon, ajouter l'intervalle actuel à la liste des résultats et mettre à jour l'intervalle actuel
            $result[] = $current;
            $current = $interval;
        }
    }

    // Ajouter le dernier intervalle fusionné à la liste des résultats
    $result[] = $current;

    // Renvoyer la liste des intervalles fusionnés
    return $result;
}

// Exemple d'appel de la fonction avec un jeu de test en entrée
$testInput = [
    [[0, 3], [6, 10]],
    [[0, 5], [3, 10]],
    [[0, 5], [2, 4]],
    [[7, 8], [3, 6], [2, 4]],
    [[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]]
];

// Affichage des résultats pour chaque jeu de test
foreach ($testInput as $input) 
{
    $result = foo($input);
    echo "Appel : foo(" . json_encode($input) . ") , sortie : " . json_encode($result) ."<br>". PHP_EOL;
}
?>
