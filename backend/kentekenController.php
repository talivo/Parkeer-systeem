<?php
session_start();

$action = $_POST['action'];

if($action == "create")
{
    $kenteken = $_POST['kenteken'];
    if(empty($kenteken)) {
        $errors[] = "Vul uw kenteken in";
    }

    if(isset($errors))
    {
        var_dump($errors);
        die();
    }

    require_once 'conn.php';
    
    $query = "SELECT * FROM numberPlates WHERE numberPlate = :numberPlate"; 
    $statement = $conn->prepare($query);
    $statement->execute([
        ":numberPlate" => $kenteken]);
    
    if ($statement->rowCount() > 0) {
        die("Dit kenteken is al geregistreerd"); // Adjusted the message to reflect the context
    }
    
    
    require_once 'conn.php';
    $query = "INSERT INTO numberPlates (numberPlate) VALUES (:numberPlate)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':numberPlate'=>$kenteken
    ]);
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);

    header('Location: ../index.php?msg=Uw auto is toegevoegd');
    exit;
}

if($action == "delete"){
    $kenteken = $_SESSION['kenteken'];

    // Query
    require_once 'conn.php';
    $query = "DELETE FROM numberPlates WHERE numberPlate = :numberPlate";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':numberPlate' => $kenteken
    ]);

    header('Location:  ../logging/thanks.php');
}