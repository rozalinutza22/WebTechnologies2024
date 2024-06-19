<?php
session_start();

$user_id = $_SESSION['user_id'];

include(dirname(__DIR__).'/models/selectList_model.php');
$model = new SelectListModel();
$lists = $model->getAllLists($user_id);
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Select list</title>
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
        <div class="search-container"></div>
    </div>

    <div class="add-list-form">
       <form action="/lists" method="post"> 
            <label for="list-name">Insert list name:</label>
            <input type="text" id="list-name" name="list_name" required>
            <button type="submit" name="add_list">Add List</button>
        </form>
    </div>

    <div class="container">
        <h2>Select a List for the Product</h2>
        <form method="post" action="selectList_controller.php">
            <input type="hidden" name="action" value="add_to_list">
            <select name="list_id" required>
                <option value="">Select List</option>
                <?php
                if (!empty($lists)) {
                    foreach ($lists as $list) {
                        if ($list['name'] != 'Favourites') {
                            echo "<option value='" . htmlspecialchars($list['id']) . "'>" . htmlspecialchars($list['name']) . "</option>";
                        }
                    }
                }
                ?>
            </select>
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($_GET['name']); ?>">
            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($_GET['price']); ?>">
            <button type="submit" name="add_to_list">Add</button>
        </form>
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
