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
                <p class="Description">Ingredients: <?php echo htmlspecialchars($productDetails['ingredients']); ?></p>
                <p>Allergens: <?php echo htmlspecialchars($productDetails['allergens']); ?></p>
                <p>
                Suitable for vegetarian diet:
                <?php echo $productDetails['vegetarian'] == 1 ? 'Yes' : 'No'; ?>
            </p>
            <p>Perishability: <?php echo htmlspecialchars($productDetails['perishability']); ?></p>
            <p>Valability: <?php echo htmlspecialchars($productDetails['valability']); ?></p>
            <p>Region: <?php echo htmlspecialchars($productDetails['region']); ?></p>
            <p>Stores: <?php echo htmlspecialchars($productDetails['stores']); ?></p>
            <p>Quantity: <?php echo htmlspecialchars($productDetails['quantity']); ?></p>
            <p>Brand: <?php echo htmlspecialchars($productDetails['brand']); ?></p>
            <p>Origin of ingredients: <?php echo htmlspecialchars($productDetails['originOfIngredients']); ?></p>
            <p>Packaging: <?php echo htmlspecialchars($productDetails['packaging']); ?></p>
            <p>NutriScore: <?php echo htmlspecialchars($productDetails['NutriScore']); ?></p>
          </div>
        <?php else : ?>
            <p>No product details available.</p>
        <?php endif; ?>
    </div>
        
    </form>
</body>