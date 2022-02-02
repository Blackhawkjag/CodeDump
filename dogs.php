<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ahcc";

    $con=mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


    $sql = "SELECT name,location,misc,meds,bath,date_in,date_out,brought FROM dogs";

    $result = $query_id = mysqli_query($con, $sql);

    foreach($result as $row)
    {
      $data[] = array(
            'name' => $row["name"],
            'location' => $row["location"],
            'misc' => $row["misc"],
            'meds' => $row["meds"],
            'bath' => $row["bath"],
            'di' => $row["date_in"],
            'do' => $row["date_out"],
            'brought' => $row["brought"]
        );
    };
    echo(json_encode($data))
?>
