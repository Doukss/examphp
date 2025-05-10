<?php
function afficherTableauAvecPagination($donnees, $entetes, $colonnes, $actions = [], $page = 1, $parPage = 10) {
    $total = count($donnees);
    $totalPages = ceil($total / $parPage);
    $donneesPage = array_slice($donnees, ($page - 1) * $parPage, $parPage);

    echo '<div class="absence-card rounded-xl border border-gray-700 overflow-hidden">';
    echo '<table class="w-full">';
    echo '<thead class="bg-gray-800"><tr>';
    foreach ($entetes as $entete) {
        echo "<th class='px-6 py-4 text-left'>{$entete}</th>";
    }
    echo '</tr></thead>';
    echo '<tbody class="divide-y divide-gray-700">';

    foreach ($donneesPage as $ligne) {
        echo '<tr class="hover:bg-gray-800/50 transition-colors">';
        foreach ($colonnes as $col) {
            echo "<td class='px-6 py-4'>{$ligne[$col]}</td>";
        }

        // Afficher les actions (boutons, liens, etc.)
        if (!empty($actions)) {
            echo '<td class="px-6 py-4"><div class="flex gap-2">';
            foreach ($actions as $action) {
                echo $action($ligne); // callback qui retourne du HTML
            }
            echo '</div></td>';
        }

        echo '</tr>';
    }

    echo '</tbody></table>';

    // Pagination
    echo '<div class="bg-gray-800 px-6 py-4 border-t border-gray-700">';
    echo '<div class="flex justify-between items-center">';
    echo "<span class='text-gray-400'>Page $page sur $totalPages</span>";
    echo '<div class="flex gap-2">';

    if ($page > 1) {
        echo '<a href="?page=' . ($page - 1) . '" class="px-3 py-1 rounded-lg bg-gray-700 hover:bg-gray-600">Précédent</a>';
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        $bg = $i === $page ? 'bg-indigo-600' : 'bg-gray-700';
        echo "<a href='?page=$i' class='px-3 py-1 rounded-lg $bg hover:bg-indigo-700'>$i</a>";
    }

    if ($page < $totalPages) {
        echo '<a href="?page=' . ($page + 1) . '" class="px-3 py-1 rounded-lg bg-gray-700 hover:bg-gray-600">Suivant</a>';
    }

    echo '</div></div></div>';
    echo '</div>';
}
