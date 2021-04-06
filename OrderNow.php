<?php include 'AGHRADI.php';
 ?>
<!DOCTYPE html>
<html>
    <head>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.3/velocity.ui.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="Style.css">
        <script src="app.js"></script>

 
    </head>
    <body>
     
    <div id="header">
            <img src="AGHRADI LOGO.svg" style="height: 100%; width: 100%; margin:auto;" alt="">
                    <ul>
                <li><a href="OrderNow.php">Order Now!</a></li><li>|</li>
                <li><a href="MyCart.php">View Cart</a></li>
                <?php
                    if(isEmployee()) echo'<li>|</li><li><a href="dashboard.php">Employee Dashboard</a></li>';
                    else echo'<li>|</li><li><a href="joinTeam.php">Deliver With Aghradi</a></li>';
                ?>
                 <li>|</li>
                <li id=Logout><a href="HomePage.php">Logout</a></li>
            </ul>
        </div>
            
       
      <?php
      
      GetOptions();
    
      ?>
            
    </body>
</html>