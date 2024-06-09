<?php
  session_start();
  $firstName = $_SESSION["user_fname"];
  $lastName = $_SESSION["user_lname"];
  $email = $_SESSION["user_email"];

?>


<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu</title>
    <style>
            <?php include "../css/menu.css" ?>
    </style>
  </head>
  <body>
    <nav>
        <ul>
          <li><a href="/menu">Home</a></li>
          <li><a href="/lists">My lists</a></li>
          <li><a href="/profile">Profile</a></li>
        </ul>
      </nav>

      <br>
      <br>
      <br>

      <h1>Browse our menu!</h1>

      <div class="searchSection">

        <div class="search-container">
          <form action="/search" method="post">
            <input type="text" placeholder="Search.." name="search" class="sc">
            <button type="submit" name="search_product" class="sButton">Search product</button>
          </form>
        </div>
    </div>

    <br>
    <br>
    <br>

    <div class="container">
      <h4 class="filter">Filter by</h4>
        <div class="filter-container">
            <label><input type="checkbox" id="product_name"> Name</label>
            <label><input type="checkbox" id="product_perishability"> Perishability</label>
            <label><input type="checkbox" id="product_price"> Price</label>
            <button type="submit">Apply filters</button>
        </div>
    </div>

    <br>

    <!-- <div class="other">
      <div class="box">
        <div class="productDetails">
          <img src="images/frenchButtercream.png" class="productImage" alt="imagine biscuiti"> 
          <div class="productText">
            <p class="productTitle">French Buttercream</p>
            <p class="productPrice">5.00 $</p>
          </div>
          <div class="product_buttons">
                    <button type="button" class="specialButtonProduct" onclick="window.location.href='/product'">View details</button>
                    <button type="submit" name="add_to_list" class="specialButtonProduct">Add to List</button>
                    <button class="favorites" onclick="window.location.href='/menu'">&#9829</button>
          </div>
          
          </div>
      </div>

      <div class="box">
        <div class="productDetails">
          <img src="images/red-lentil-soup-with-beet-greens.jpg" class="productImage" alt="imagine lentil soup"> 
          <div class="productText">
            <p class="productTitle">Red lentil soup</p>
            <p class="productPrice">3.00 $</p>
          </div>
          <div class="product_buttons">
                    <button type="button" class="specialButtonProduct" onclick="window.location.href='/product'">View details</button>
                    <button type="submit" name="add_to_list" class="specialButtonProduct">Add to List</button>
                    <button class="favorites" onclick="window.location.href='/menu'">&#9829</button>
          </div>
          </div>
      </div>

      <div class="box">
        <div class="productDetails">
          <img src="images/prajiturele.png" class="productImage" alt="imagine prajiturele"> 
          <div class="productText">
            <p class="productTitle">Special Homemade Sweet</p>
            <p class="productPrice">4.00 $</p>
          </div>
          <div class="product_buttons">
                    <button type="button" class="specialButtonProduct" onclick="window.location.href='/product'">View details</button>
                    <button type="submit" name="add_to_list" class="specialButtonProduct">Add to List</button>
                    <button class="favorites" onclick="window.location.href='/menu'">&#9829</button>
           </div>
        </div>
      </div>

      <div class="box">
        <div class="productDetails">
          <img src="images/burgerMenu.png" class="productImage" alt="imagine meniu"> 
          <div class="productText">
            <p class="productTitle">Burger Menu</p>
            <p class="productPrice">15.00 $</p>
          </div>
          <div class="product_buttons">
                    <button type="button" class="specialButtonProduct" onclick="window.location.href='/product'">View details</button>
                    <button type="submit" name="add_to_list" class="specialButtonProduct">Add to List</button>
                    <button class="favorites" onclick="window.location.href='/menu'">&#9829</button>
          </div>
        </div>
      </div>
    </div> -->

    <?php
    if (isset($_SESSION["searchResults"])) {
        $searchResults = $_SESSION["searchResults"];

        if (!empty($searchResults)) {
            foreach ($searchResults as $product) {
                // $imagePath = "../public/products_images/{$product['image']}";
                $imagePath = "../public/products_images/{$product['image']}";

                echo "<div class='box'>";
                echo "<div class='productDetails'>";
                echo "<img src='{$imagePath}' class='productImage' alt='{$product['name']}'>";
                echo "<div class='productText'>";
                echo "<p class='productTitle'>{$product['name']}</p>";
                echo "<p class='productPrice'>{$product['price']} $</p>";
                echo "</div>";
                echo "<div class='product_buttons'>";
                echo "<button type='button' class='specialButtonProduct' onclick='window.location.href=\"/product/{$product['id']}\"'>View details</button>";
                echo "<button type='submit' name='add_to_list' class='specialButtonProduct'>Add to List</button>";
                echo "<button class='favorites' onclick='window.location.href=\"/menu\"'>&#9829;</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No results found.</p>";
        }

        unset($_SESSION["searchResults"]);
    } else {
        echo "<p>No results found.</p>";
    }
    ?>

  </body>
</html>