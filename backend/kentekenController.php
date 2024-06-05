<?php

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
    $query = "INSERT INTO numberPlates (numberPlate) VALUES (:kenteken)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':kenteken'=>$kenteken
    ]);
    $numerPlates = $statement->fetchAll(PDO::FETCH_ASSOC);

    header('Location: ../index.php?msg=Uw auto is toegevoegd');
    exit;
}

if($action == "delete"){
    $id = $_POST['id'];
    require_once 'conn.php';
    $query = "DELETE FROM berichten WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':id' => $id
    ]);

    header('Location:  ../index.php?msg=Melding verwijderd');
}