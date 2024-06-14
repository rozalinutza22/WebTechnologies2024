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

    <div class="other">
        <?php 
        if (isset($_SESSION["searchResults"])) {
          $searchResults = $_SESSION["searchResults"]; 
        if (!empty($searchResults)) {
          foreach ($searchResults as $product): ?>
    <div class="box">
        <div class="productDetails">
          <?php $imagePath = "../public/products_images/{$product['image']}";?>
            <img src="../public/products_images/<?php echo htmlspecialchars($product['image']); ?>" class="productImage" alt="<?php echo htmlspecialchars($product['name']); ?>">
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
      <?php endforeach; 
      } else {
        echo "<p>No results found.</p>";
      }

      unset($_SESSION["searchResults"]);
    } else {
      echo "<p>No results found.</p>";
    }
    ?>

  </div>
  </body>
</html>