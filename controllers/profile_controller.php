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
                    updateSessionData($userData);
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
            return getUserDataFromCSV($filePath); 
        } else {
            echo "Failed to import CSV file.";
            return false;
        }
    }
    
    function getUserDataFromCSV($filePath) {
        $handle = fopen($filePath, 'r');
        $userData = [];
    
        if ($handle !== FALSE) {
            $columns = fgetcsv($handle, 1000, ",");
            
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $userData[] = [
                    'id' => $data[0],
                    'firstName' => $data[1],
                    'lastName' => $data[2],
                    'emailAdress' => $data[3],
                    'phoneNumber' => $data[4],
                    'passwrd' => $data[5],
                    'vegetarian' => (int)$data[6],
                    'admin' => (int)$data[7],
                    'allergens' => $data[8],
                    'session_token' => $data[9],
                    'last_login' => $data[10],
                    'session_expiry' => $data[11]
                ];
            }
    
            fclose($handle);
        }
    
        return $userData;
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
    
    function updateSessionData($userData) {
        $_SESSION['id'] = $userData['id'];
        $_SESSION['firstName'] = $userData['firstName'];
        $_SESSION['lastName'] = $userData['lastName'];
        $_SESSION['emailAdress'] = $userData['emailAdress'];
        $_SESSION['phoneNumber'] = $userData['phoneNumber'];
        $_SESSION['vegetarian'] = $userData['vegetarian'];
        $_SESSION['admin'] = $userData['admin'];
        $_SESSION['allergens'] = $userData['allergens'];
        $_SESSION['session_token'] = $userData['session_token'];
        $_SESSION['last_login'] = $userData['last_login'];
        $_SESSION['session_expiry'] = $userData['session_expiry'];
    }

    
?>