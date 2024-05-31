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
        if (!empty($lists)) {
            foreach ($lists as $list) {
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
        } else {
            echo "<p>No lists found. Add a new list to get started.</p>";
        }
        ?>
    </div>

    <div class="other">
        <h1 class="subtitle">Other things you might like:</h1>

        <div class="box">
            <div class="productDetails">
                <img src="images/frenchButtercream.png" class="productImage" alt="imagine biscuiti">
                <div class="productText">
                    <p class="productTitle">French Buttercream</p>
                    <p class="productPrice">5.00 $</p>
                </div>
                <form action="/lists" method="post">
                    <input type="hidden" name="product_name" value="French Buttercream">
                    <button type="submit" name="add_to_list" class="specialButtonProduct">Add to List</button>
                </form>
            </div>
        </div>

        <div class="box">
            <div class="productDetails">
                <img src="images/red-lentil-soup-with-beet-greens.jpg" class="productImage" alt="imagine lentil soup">
                <div class="productText">
                    <p class="productTitle">Red lentil soup with beet greens</p>
                    <p class="productPrice">3.00 $</p>
                </div>
                <form action="/lists" method="post">
                    <input type="hidden" name="product_name" value="Red lentil soup with beet greens">
                    <button type="submit" name="add_to_list" class="specialButtonProduct">Add to List</button>
                </form>
            </div>
        </div>

        <div class="box">
            <div class="productDetails">
                <img src="images/prajiturele.png" class="productImage" alt="imagine prajiturele">
                <div class="productText">
                    <p class="productTitle">Special Homemade Sweet</p>
                    <p class="productPrice">4.00 $</p>
                </div>
                <form action="/lists" method="post">
                    <input type="hidden" name="product_name" value="Special Homemade Sweet">
                    <button type="submit" name="add_to_list" class="specialButtonProduct">Add to List</button>
                </form>
            </div>
        </div>

        <div class="box">
            <div class="productDetails">
                <img src="images/burgerMenu.png" class="productImage" alt="imagine meniu">
                <div class="productText">
                    <p class="productTitle">Burger Menu</p>
                    <p class="productPrice">15.00 $</p>
                </div>
                <form action="/lists" method="post">
                    <input type="hidden" name="product_name" value="Burger Menu">
                    <button type="submit" name="add_to_list" class="specialButtonProduct">Add to List</button>
                </form>
            </div>
        </div>

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
