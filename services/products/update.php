<?php

ini_set("display_errors", 1);
ini_set('error_log','error_log.txt');

$formData = array();
parse_str($_POST['formData'], $formData);

// array for JSON response
$response = array();

//error_log(print_r($formData,1));

// check for required fields
if (isset($formData['id']) && isset($formData['firstname']) && isset($formData['lastname']) && isset($formData['title']) && isset($formData['email'])  && isset($formData['department'])  && isset($formData['city'])) {
    
    //error_log(print_r($formData,1));
    
    $id = $formData['id'];
    $firstName = $formData['firstname'];
    $lastName = $formData['lastname'];
    $title = $formData['title'];
    $department = $formData['department'];
    $email = $formData['email'];
    $city = $formData['city'];
    
    $sql = "UPDATE address SET firstname = :firstName, lastname = :lastName, title = :title, email = :email, department = :department, city = :city WHERE id = :id";

    include '../db_config.php';
    try {
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Bind params
        $stmt = $dbh->prepare($sql); 
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR); 
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR); 
        $stmt->bindParam(':title', $title, PDO::PARAM_STR); 
        $stmt->bindParam(':department', $department, PDO::PARAM_STR); 
        //$stmt->bindParam(':officePhone', $officePhone, PDO::PARAM_STR); 
        //$stmt->bindParam(':cellPhone', $cellPhone, PDO::PARAM_STR); 
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); 
        $stmt->bindParam(':city', $city, PDO::PARAM_STR); 
        
        //Execute query
        $res = $stmt->execute();
        $dbh = null;
        
    } catch(PDOException $e) {
            echo '<pre>';
            echo 'Regel: '.$e->getLine().'<br>'; 
            echo 'Bestand: '.$e->getFile().'<br>'; 
            echo 'Foutmelding: '.$e->getMessage(); 
            echo '</pre>';
    }

    // check if row inserted or not
    if ($res) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Update successfull";
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to update row
        $response["success"] = 0;
        $response["message"] = "Error updating data";
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
   
    // echoing JSON response
    echo json_encode($response);
}
?>