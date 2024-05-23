<?php

function displayLists($lists) {
    echo "<div class='container'>";
    if (!empty($lists)) {
        foreach ($lists as $list) {
            echo "<div class='white-box'>";
            echo "<div class='titluLista'>" . htmlspecialchars($list['name']) . "</div>";

            // Display list items
            $items = getListItems($list['id']);
            foreach ($items as $item) {
                echo "<div class='denumire'>" . htmlspecialchars($item['name']) . "</div>";
                echo "<div class='pret'>$" . htmlspecialchars($item['price']) . "</div>";
                echo "<div style='clear: both;'></div>";
            }

            echo "<hr>";

            echo "<div style='float: left;'>Total:</div>";
            echo "<div style='float: right;'>$" . calculateTotal($items) . "</div>";
            echo "<div style='clear: both;'></div>";

            echo "<a href='delete_list.php?id=" . htmlspecialchars($list['id']) . "' class='deleteButton' onclick='return confirm(\"Are you sure you want to delete this list?\")'>Delete</a>";

            echo "</div>";
        }
    } else {
        echo "<p>No lists found. Add a new list to get started.</p>";
    }
    echo "</div>";
}

function calculateTotal($items) {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'];
    }
    return $total;
}
?>
