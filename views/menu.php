<?php
  session_start();
  $firstName = $_SESSION["user_fname"];
  $lastName = $_SESSION["user_lname"];
  $email = $_SESSION["user_email"];
  // $productsByName = $_SESSION["productsByName"];
  // $productsByPrice = $_SESSION["productsByPrice"];
  // $productsByPerishability = $_SESSION["productsByPerishability"];
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
          <form action="/search" method="post">
            <button type="submit" name="filter_name">Name</button>
            <button type="submit" name="filter_perishability">Perishability</button>
            <button type="submit" name="filter_price">Price</button>
          </form>
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
          <?php $imagePath = "images/{$product['image']}";?>
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
      <?php endforeach; 
      } else {
        echo "<p>No results found.</p>";
      }

      unset($_SESSION["searchResults"]);
    } else if (!isset($_SESSION["searchResults"]) && !isset($_SESSION["productsByName"]) && !isset($_SESSION["productsByPrice"]) && !isset($_SESSION["productsByPerishability"])){ ?>

      <?php 
      $allProducts = $_SESSION["allProducts"];
      $currentCategory = null;
 
      foreach ($allProducts as $product): 
        if ($product['category'] !== $currentCategory):
          if ($currentCategory !== null): 
          endif;
          $currentCategory = $product['category'];
          echo "<h3>" . htmlspecialchars($currentCategory) . ":</h3>";
        endif;
      ?>
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
      <?php endforeach; 
      }
      ?>

  <!-- pentru filtrare -->

  <?php
    if (isset($_SESSION['productsByName'])) { ?>

    <?php
      $currentCategory = null;
      $productsByName = $_SESSION['productsByName'];
 
      foreach ($productsByName as $product): 
        if ($product['category'] !== $currentCategory):
          if ($currentCategory !== null): 
          endif;
          $currentCategory = $product['category'];
          echo "<h3>" . htmlspecialchars($currentCategory) . ":</h3>";
        endif;
    ?>

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
      <?php endforeach; 
      }
      unset($_SESSION["productsByName"]);
      ?>

<?php
    if (isset($_SESSION['productsByPrice'])) { ?>

    <?php
      $currentCategory = null;
      $productsByPrice = $_SESSION['productsByPrice'];
 
      foreach ($productsByPrice as $product): 
        if ($product['category'] !== $currentCategory):
          if ($currentCategory !== null): 
          endif;
          $currentCategory = $product['category'];
          echo "<h3>" . htmlspecialchars($currentCategory) . ":</h3>";
        endif;
    ?>

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
      <?php endforeach; 
      }
      unset($_SESSION["productsByPrice"]);
      ?>

<?php
    if (isset($_SESSION['productsByPerishability'])) { ?>

    <?php
      $currentCategory = null;
      $productsByPrice = $_SESSION['productsByPerishability'];
 
      foreach ($productsByPrice as $product): 
        if ($product['category'] !== $currentCategory):
          if ($currentCategory !== null): 
          endif;
          $currentCategory = $product['category'];
          echo "<h3>" . htmlspecialchars($currentCategory) . ":</h3>";
        endif;
    ?>

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
      <?php endforeach; 
      }
      unset($_SESSION["productsByPerishability"]);
      ?>

  </body>
</html>