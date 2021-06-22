<?php
    //Make connection to database
    include '../Connection.php';

    //run query to select all records from prodsucts table
    //kina ki userid ra trader id same banauchu e.g => insert into trader values(1,1)
    $query="SELECT profile_img FROM users where user_id = '$userId'";

    //store the result of the query in a variable called $result
    $result=mysqli_query($connection, $query);


    while ($row=mysqli_fetch_assoc($result)){
        echo "<div class='user-profile-header'>";
            echo "<img src='".$row['profile_img']."' alt='profile' width='40px' height='40px'>";
        echo "</div>";
    }
?>



