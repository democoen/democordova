<?php
/* 
 * Following code will create a new address, all details are read from HTTP Post Request
 * Testing on command pronpt:
 * curl -X POST -F firstName=Jan -F lastName=Jansen -F title=Titel -F department=Department -F officePhone=123 -F cellPhone=4567 -F email=email -F city=Amsterdam http://test:8888/services/create_address.php
 */

ini_set("display_errors", 1);
ini_set('error_log','error_log.txt');

include '../db_config.php';

// array for JSON response
$formData = array();
parse_str($_POST['formData'], $formData);

$response = array();

// check for required fields
if (isset($formData['firstName']) && isset($formData['lastName']) && isset($formData['title']) && isset($formData['department']) && isset($formData['officePhone']) && isset($formData['cellPhone']) && isset($formData['email']) && isset($formData['city'])) {
    
    $firstName = $formData['firstName'];
    $lastName = $formData['lastName'];
    $title = $formData['title'];
    $department = $formData['department'];
    $officePhone = $formData['officePhone'];
    $cellPhone = $formData['cellPhone'];
    $email = $formData['email'];
    $city = $formData['city'];
    
    // mysql insert new row
    $sql  = " INSERT INTO address(firstName, lastName, title, department, officePhone, cellPhone, email, city, managerId)";
    $sql .= " VALUES (:firstName, :lastName, :title, :department, :officePhone, :cellPhone, :email, :city, 0)";

    try {
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Bind params
        $stmt = $dbh->prepare($sql); 
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR); 
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR); 
        $stmt->bindParam(':title', $title, PDO::PARAM_STR); 
        $stmt->bindParam(':department', $department, PDO::PARAM_STR); 
        $stmt->bindParam(':officePhone', $officePhone, PDO::PARAM_STR); 
        $stmt->bindParam(':cellPhone', $cellPhone, PDO::PARAM_STR); 
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

    // Check if row inserted or not
    if ($res) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Item successfully created.";
        
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "An error occurred.";
        
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