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
          <li><a href="/principal">Home</a></li>
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
          <form action="/action_page.php">
            <input type="text" placeholder="Search.." name="search" class="sc">
            <button type="submit" class="searchB"><i class="fa fa-search"></i></button>
          </form>
        </div>
    </div>

    <br>
    <br>
    <br>

    <div class="container">
      <h4 class="filter">Filter by</h4>
        <div class="filter-container">
            <label><input type="checkbox" id="sizeSmall"> Small</label>
            <label><input type="checkbox" id="sizeMedium"> Medium</label>
            <label><input type="checkbox" id="sizeLarge"> Large</label>
        </div>
    </div>

    <br>
    <!-- <br>
    <br> -->

    <div class="other">
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
    </div>

  </body>
</html>