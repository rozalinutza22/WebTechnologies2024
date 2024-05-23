<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My lists</title>
    <link href="css/cumparaturi.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="menu.html">Home</a></li>
            <li><a href="cumparaturi.php">My lists</a></li>
            <li><a href="profile.html">Profile</a></li>
        </ul>
    </nav>

    <div class="searchSection">
        <div class="textTitle">All you need is here</div>
        <div class="search-container">
            <!-- <form action="cumparaturi.php" method="post">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form> -->
        </div>
    </div>

    <div class="add-list-form">
        <form action="cumparaturi.php" method="post">
            <label for="list-name">Insert list name:</label>
            <input type="text" id="list-name" name="list_name" required>
            <button type="submit" name="add_list">Add List</button>
        </form>
    </div>

    <?php
    include 'controllers/cumparaturi_controller.php';
    ?>

<div class="other">

<h1 class="subtitle">Other things you might like: </h1>
  

<div class="box">
  <div class="productDetails">
    <img src="../images/frenchButtercream.png" class="productImage" alt="imagine biscuiti"> 
    <div class="productText">
    <p class="productTitle">French Buttercream</p>
    <p class="productPrice">5.00 $</p>
    </div>
    <a href="produs.html"><button class="specialButtonProduct" >View details</button></a>
    </div>
</div>
<div class="box">
  <div class="productDetails">
    <img src="../images/red-lentil-soup-with-beet-greens.jpg" class="productImage" alt="imagine lentil soup"> 
    <div class="productText">
    <p class="productTitle">Red lentil soup with beet greens</p>
    <p class="productPrice">3.00 $</p>
    </div>
    <a href="produs.html"><button class="specialButtonProduct">View details</button></a>
    </div>
</div>
<div class="box">
  <div class="productDetails">
    <img src="../images/prajiturele.png" class="productImage" alt="imagine prajiturele"> 
    <div class="productText">
    <p class="productTitle">Special Homemade Sweet</p>
    <p class="productPrice">4.00 $</p>
    </div>
    <a href="produs.html"><button class="specialButtonProduct">View details</button></a>
  </div>
</div>
<div class="box">
  <div class="productDetails">
    <img src="../images/burgerMenu.png" class="productImage" alt="imagine meniu"> 
    <div class="productText">
    <p class="productTitle">Burger Menu</p>
    <p class="productPrice">15.00 $</p>
    </div>
    <a href="produs.html"><button class="specialButtonProduct">View details</button></a>
  </div>
</div>
</div>


<div class="detaliiFinal">
<img class="logo" src="../images/logo.png" alt="logo">
<div class="detaliiContact">
<p class="footerTitle">Contact us at:</p>
<p class="footerText">FoodStash@gmail.com</p>
<p class="footerText">0769436813</p>
</div>
</div>


</body>