<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>

  <!--Bootstrap CDN Link-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

  <!--External CSS Link-->
  <link rel="stylesheet" href="dashboard.css" />

  <!-- Font awesome CDN -->
    <script src="https://kit.fontawesome.com/962cfbd2be.js" crossorigin="anonymous"></script>

</head>

<!--Trader Panel-->

<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <?php include '../trader-side-panel.php'; ?>

        <!--Add Products Container Column-->
        <div class="col-xl-10 mx-auto p-0">
          <?php include '../user_profile_header.php'; ?>

          <div class="user-profile-header">
            <img src="pexels-pixabay-220453.jpg" alt="profile" width="40px" height="40px">
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>

  <!--JS Bootstrap Bundle-->
  <!--JQuery CDN link-->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <!--Font Awesome CDN Link-->
  <script src="https://kit.fontawesome.com/962cfbd2be.js"></script>
</body>

</html>
