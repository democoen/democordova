<?php

    ini_set("display_errors", 1);
    ini_set('error_log','error_log.txt'); 
    
    // array for JSON response
    $response = array();

    // check for required fields
    if (isset($_POST['id'])) {
        
        include '../db_config.php';
        
        $sql = "DELETE FROM address WHERE id = :id";
        
        try {
            $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);  
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //Bind param
            $stmt = $dbh->prepare($sql); 
            $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_STR); 
            
            //Execute query
            $res = $stmt->execute(); 
            $dbh = null;
            
        } catch(PDOException $e) {
            echo $e->getMessage(); 
        }


        // check if row deleted or not
        if ($res) {
            // successfully updated
            $response["success"] = 1;
            $response["message"] = "Item successfully deleted";
        
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no item found
            $response["success"] = 0;
            $response["message"] = "No item found";
            
            // echo no users JSON
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