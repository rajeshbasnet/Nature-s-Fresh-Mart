<form action="" method="POST">
    <input type="text" value="5" name="value" readonly>
    <button type="submit" name="submit">Submit</button>
</form>


<?php

if(isset($_POST['submit'])) {
    echo $_POST['value'];
}

echo md5("saugat123");


echo date('Y-m-d');