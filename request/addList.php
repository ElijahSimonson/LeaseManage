<?php  
include('../source/api.php');


if ($_FILES['csv']['size'] > 0) { 

    //get the csv file 
    $file = $_FILES['csv']['tmp_name']; 
    $handle = fopen($file,"r");
    
    //loop through the csv file and insert into database 
    while ($data = fgetcsv($handle,1000,",","'")){ 
        if ($data[1] != "Serial Number"){ 
            if (!checkExists($data[1])){
            $serial = $data[1];
            //$index = "INSERT INTO ownedleased (serialNumber, ownedleased) VALUES ('$serial', 'leased')"; 
            $exDate = explode(" ", $data[9]);
            $mDate = date('m', strtotime($data[9]));
            $date = $exDate[0] . "/" . $mDate . "/" . $exDate[2];
            $lease = $data[2];
            echo "$serial, $lease, $date";
           //$leased = "INSERT INTO leased (serialNumber, assocList, date) VALUES ('$serial', '$lease', '$date')";
            //$db->exec($index);
            //$db->exec($leased);
            //saveQr($serial);
        }
    }
    } ;
    // 

    //redirect 
   // header('Location: ../leaseAdd.php?success=1'); die; 

} else{
    //header('Location: ../leaseAdd.php?success=0'); die;
}

?> 