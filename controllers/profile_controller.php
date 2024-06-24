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
        $userData = $model->exportJson($_SESSION['user_id']);
        $id = $_SESSION['user_id'];

        if ($userData) {
            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="user_' . $id . '.json"');
        
            echo json_encode($userData);
            exit;
        } else {
            echo "User not found";
            header("Location: /menu"); 
            exit();
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export_csv'])) {
        $userData = $model->exportJson($_SESSION['user_id']);
        $id = $_SESSION['user_id'];

        if ($userData) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="user_' . $id . '.csv"');

            $output = fopen('php://output', 'w');

            fputcsv($output, array_keys($userData));

            fputcsv($output, $userData);

            fclose($output);
        } else {
            echo "User not found";
            header("Location: /menu"); 
            exit();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['import_csv'])) {
            if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
                $csvFile = $_FILES['csv_file']['tmp_name'];
                $userData = importCSV($csvFile, $model);
                if ($userData) {
                    updateSessionDataCSV($userData);
                    header("Location: /profile"); 
                     exit();
                }
                
            }
        } elseif (isset($_POST['import_json'])) {
            if (isset($_FILES['json_file']) && $_FILES['json_file']['error'] == 0) {
                $jsonFile = $_FILES['json_file']['tmp_name'];
                $userData = importJSON($jsonFile, $model);
                if ($userData) {
                    updateSessionData($userData);
                    header("Location: /profile"); 
                    exit();
                }
            }
        }
    }

    function importCSV($filePath, $model) {
        // Apelează funcția din model pentru CSV
        $result = $model->processCSV($filePath);
        if ($result) {
            echo "CSV file imported successfully.";
            return $result; 
        } else {                 
            echo "Failed to import CSV file.";
            return false;
        }
    }
    
    function importJSON($filePath, $model) {
        // Apelează funcția din model pentru JSON
        $result = $model->processJSON($filePath);
        if ($result) {
            echo "JSON file imported successfully.";
            return $result; 
        } else {
            echo "Failed to import JSON file.";
            return false;
        }
    }

    function updateSessionDataCSV($userData) {
        $_SESSION['id'] = $userData[0];
        $_SESSION['user_fname'] = $userData[1];
        $_SESSION['user_lname'] = $userData[2];
        $_SESSION['user_email'] = $userData[3];
        $_SESSION['user_phone'] = $userData[4];
        $_SESSION['vegetarian'] = (int)$userData[5];
        $_SESSION['admin'] = (int)$userData[6];
        $_SESSION['allergens'] = $userData[7];
        $_SESSION['session_token'] = $userData[8];
        $_SESSION['last_login'] = $userData[8];
        $_SESSION['session_expiry'] = $userData[10];
    }
    
    function updateSessionData($userData) {
        $_SESSION['id'] = $userData['id'];
        $_SESSION['user_fname'] = $userData['firstName'];
        $_SESSION['user_lname'] = $userData['lastName'];
        $_SESSION['user_email'] = $userData['emailAdress'];
        $_SESSION['user_phone'] = $userData['phoneNumber'];
        $_SESSION['vegetarian'] = $userData['vegetarian'];
        $_SESSION['admin'] = $userData['admin'];
        $_SESSION['allergens'] = $userData['allergens'];
        $_SESSION['session_token'] = $userData['session_token'];
        $_SESSION['last_login'] = $userData['last_login'];
        $_SESSION['session_expiry'] = $userData['session_expiry'];
    }

    
?>