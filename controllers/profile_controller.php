<?php
    include(dirname(__DIR__).'/models/profile_model.php');
    $model = new DeleteAccModel();
    session_start();
    $email = $_SESSION['user_email'];
    $_SESSION['user_id'] = $model->getId($email);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete-user'])) {
        $res = $model->deleteUserLists($_SESSION['user_id']);
        $allProducts = $model->deleteUserPref($_SESSION['user_id']);
        $all = $model ->deleteUser($_SESSION['user_id']);
    
        header("Location: /principal"); 
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export'])) {
        $res = $model->exportJson($_SESSION['user_id']);

        if (!isset($_SESSION['user_email'])) {
            die("n avem email.");
        }

        if (!isset($_SESSION['user_id'])) {
            die("id-ul nu este setat.");
        }

        $id = $_SESSION['user_id'];
        // var_dump($res);

        if (!empty($res)) {
            // $json = json_encode($res);
            // $jsonLength = mb_strlen($json, '8bit');
            // echo "Data:" . $json;
            // header('Content-Type: application/json');
            // header('Content-Disposition: attachment; filename="userData.json"');
            // header('Content-Length: ' . $jsonLength);
            // ob_start();
            // echo $json;
            // ob_end_flush();
            file_put_contents('C:\Users\helen.ro\Downloads\userData.json', json_encode($res));
        } else {
            header("Location: /menu"); 
            exit();
        }
    
        header("Location: /profile"); 
        exit();
    }
?>