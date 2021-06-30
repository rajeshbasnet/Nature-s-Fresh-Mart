<?php
    //Make connection to database
    include 'Connection.php';

    //run query to select all records from prodsucts table
    //kina ki userid ra trader id same banauchu e.g => insert into trader values(1,1)
    $query="SELECT PROFILE_IMG FROM users where USER_ID = 16";

    //store the result of the query in a variable called $result
    $result = oci_parse($connection, $query);
    oci_execute($result);

    while ($row = oci_fetch_assoc($result)){
        echo "<div class='user-profile-header'>";
            echo "<img src='".$row['PROFILE_IMG']."' alt='profile' width='40px' height='40px'>";
        echo "</div>";
    }
?>