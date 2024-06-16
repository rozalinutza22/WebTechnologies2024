<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product description</title>
    <!-- <link href="../css/produs.css" rel="stylesheet" type="text/css"> -->
    <style>
            <?php include "../css/produs.css" ?>
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

    <div class="productDetails">
        <?php if (isset($productDetails)) : ?>
          <img src="images/<?php echo htmlspecialchars($productDetails['image']); ?>" class="productImage" alt="<?php echo htmlspecialchars($productDetails['name']); ?>">
            <div class="ProductText">
                <p class="Title"><?php echo htmlspecialchars($productDetails['name']); ?></p>
                <p class="subtitle">Ingredients:</p><p> <?php echo htmlspecialchars($productDetails['ingredients']); ?></p>
                <p class="subtitle">Allergens:</p><p> <?php echo htmlspecialchars($productDetails['allergens']); ?></p>
                <p class="subtitle">Suitable for vegetarian diet:</p><p>
                <?php echo $productDetails['vegetarian'] == 1 ? 'Yes' : 'No'; ?>
            </p>
            <p class="subtitle">Perishability:</p><p><?php echo htmlspecialchars($productDetails['perishability']); ?></p>
            <p class="subtitle">Valability:</p><p><?php echo htmlspecialchars($productDetails['valability']); ?></p>
            <p class="subtitle">Region:</p><p> <?php echo htmlspecialchars($productDetails['region']); ?></p>
            <p class="subtitle">Stores:</p><p><?php echo htmlspecialchars($productDetails['stores']); ?></p>
            <p class="subtitle">Quantity:</p><p><?php echo htmlspecialchars($productDetails['quantity']); ?></p>
            <p class="subtitle">Brand:</p><p><?php echo htmlspecialchars($productDetails['brand']); ?></p>
            <p class="subtitle">Origin of ingredients:</p><p><?php echo htmlspecialchars($productDetails['originOfIngredients']); ?></p>
            <p class="subtitle">Packaging:</p><p><?php echo htmlspecialchars($productDetails['packaging']); ?></p>
            <p class="subtitle">Nutri score:</p><p><?php echo htmlspecialchars($productDetails['NutriScore']); ?></p>
          </div>
        <?php else : ?>
            <p>No product details available.</p>
        <?php endif; ?>
    </div>
        
    </form>
</body>