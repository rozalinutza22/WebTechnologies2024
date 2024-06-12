<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My lists</title>
    <style><?php include(dirname(__DIR__).'/css/cumparaturi.css'); ?></style> 
   
</head>
<body>
    <nav>
        <ul>
            <li><a href="/menu">Home</a></li>
            <li><a href="/lists">My lists</a></li>
            <li><a href="/profile">Profile</a></li>
        </ul>
    </nav>

    <div class="searchSection">
        <div class="textTitle">All you need is here</div>
        <div class="search-container">
        </div>
    </div>

    <div class="add-list-form">
       <form action="/lists" method="post"> 
            <label for="list-name">Insert list name:</label>
            <input type="text" id="list-name" name="list_name" required>
            <button type="submit" name="add_list">Add List</button>
        </form>
    </div>

    <div class="container">
         <?php

    echo "<div class='favourites-box'>";
    echo "<div class='titluLista'> Favourites </div>";

    // Display 'Favourites' list items
    $favouritesList = null;
    foreach ($lists as $list) {
        if ($list['name'] === 'Favourites') {
            $favouritesList = $list;
            break;
        }
    }

    if ($favouritesList) {
        $items = $model->getListItems($favouritesList['id']);
        foreach ($items as $item) {
            echo "<form action='/lists' method='post'>";
            echo "<input type='hidden' name='item_name' value='" . htmlspecialchars($item['name']) . "'>";
            echo "<button type='submit' name='remove_from_favourites' class='removeButton' onclick='return confirm(\"Are you sure you want to remove this item?\")'>Remove</button>";
            echo "</form>";
            echo "<div class='denumire'>" . htmlspecialchars($item['name']) . "</div>";
            echo "<div class='pret'>$" . htmlspecialchars($item['price']) . "</div>";
            echo "<div style='clear: both;'></div>";
        }
    
    echo "<hr>";

    echo "<div style='float: left;'>Total:</div>";
    echo "<div style='float: right;'>$" . calculateTotal($items) . "</div>";
    echo "<div style='clear: both;'></div>";
} else {
    echo "<p>No items found in Favourites list.</p>";
}

    echo "</div>";

// Display other lists
if (!empty($lists)) {
    foreach ($lists as $list) {
        if ($list['name'] != 'Favourites') {
            echo "<div class='white-box'>";
            echo "<div class='titluLista'>" . htmlspecialchars($list['name']) . "</div>";

            // Display list items
            $items = $model->getListItems($list['id']);
            foreach ($items as $item) {
                echo "<div class='denumire'>" . htmlspecialchars($item['name']) . "</div>";
                echo "<div class='pret'>$" . htmlspecialchars($item['price']) . "</div>";
                echo "<div style='clear: both;'></div>";
            }

            echo "<hr>";

            echo "<div style='float: left;'>Total:</div>";
            echo "<div style='float: right;'>$" . calculateTotal($items) . "</div>";
            echo "<div style='clear: both;'></div>";

            // Form to delete list
            echo "<form action='/lists' method='post'>";
            echo "<input type='hidden' name='list_id' value='" . htmlspecialchars($list['id']) . "'>";
            echo "<button type='submit' name='delete_list' class='deleteButton' onclick='return confirm(\"Are you sure you want to delete this list?\")'>Delete</button>";
            echo "</form>";

            echo "</div>";
        }
    }
}

?>
</div>


    <div class="other">
        <h1 class="subtitle">Other things you might like:</h1>
    
        <?php foreach ($recommendedProducts as $product): ?>
    <div class="box">
        <div class="productDetails">
            <img src="images/<?php echo htmlspecialchars($product['image']); ?>" class="productImage" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <div class="productText">
                <p class="productTitle"><?php echo htmlspecialchars($product['name']); ?></p>
                <p class="productPrice"><?php echo htmlspecialchars($product['price']); ?> $</p>
            </div>
            <form action="/lists" method="post">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>">
                <div class="product_buttons">
                    <button type="submit" name="view_details" class="specialButtonProduct">View details</button>
                    <button type="submit" name="add_to_list" class="specialButtonProduct">Add to List</button>
                    <button class="favorites" type="submit" name="add_to_favourites">&#9829</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

    </div>

    <div class="detaliiFinal">
        <img class="logo" src="images/logo.png" alt="logo">
        <div class="detaliiContact">
            <p class="footerTitle">Contact us at:</p>
            <p class="footerText">FoodStash@gmail.com</p>
            <p class="footerText">0769436813</p>
        </div>
    </div>

</body>
</html>
