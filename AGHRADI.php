<?php

$GLOBALS['thisEmployee']=NULL;
$GLOBALS['thisCustomer']=NULL;
GetActiveAccount();

function GetActiveAccount(){
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM ActiveAccount";
    $cresult = mysqli_query($conn, $sql);
    
    if($crow = mysqli_fetch_assoc($cresult)){
        $GLOBALS['thisCustomer']=$crow["CID"];
        isEmployee();
    }
    else{
        $GLOBALS['thisCustomer']=NULL; 
    }
    
     
}
function isEmployee(){
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM isEmployee WHERE CID=".$GLOBALS['thisCustomer'];
    $result = mysqli_query($conn, $sql);
    $conn -> close();
    if($row = mysqli_fetch_assoc($result)){
        $GLOBALS['thisEmployee']=$row["EID"];
        return true;
    }
    else{
        $GLOBALS['thisEmployee']=NULL;
        return false;
    }

}

function inStock($PID,$Quantity){
    GetActiveAccount();
    
    
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Quantity FROM Parts WHERE PID=".$PID;
    $result = mysqli_query($conn, $sql);
    
   $row = mysqli_fetch_assoc($result);
   $conn -> close();

   if($row["Quantity"]>=$Quantity){
  
       return true;
   }
   else{
       return false;
   }
}

function GetCustomers(){
    
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo'<div id="Customer" class="Container"><h3>Customer Table</h3><table class="table table-bordered" > <thead class="thead-dark"><tr><th>CID</th><th>Name</th><th>Phone</th><th>Country</th><th>City</th><th>Street</th><th>Email</th><th>Remove User</th></tr></thead>';
    
    $sql = "SELECT * FROM customer";
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["CID"]. " </td><td> ".$row["FirstName"]." ". $row["LastName"]." </td><td>" .$row["Phone"]. "</td><td>".$row["Country"]."</td><td>".$row["City"]."</td><td>".$row["Street"]."</td><td>".$row["Email"]."</td>";
        echo' <form action="AGHRADI.php" method="post" target="_blank"><input type="hidden" name="RemoveCustomer" value="'.$row["CID"].'"><td style="padding: 0; position: relative;"><button type="submit" onclick="RemoveParent(this)" class="btn btn-primary fullHeight" style="border-radius: 0px;" onclick="RemoveCustomer('.$row["CID"].')">-</button></td></form></tr>';
    }
    
    echo '</table><br></div>';

    $conn -> close();
}

function GetTasks(){
   
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    echo'<div class="Container">
    <h3>Your Tasks to be Delivered</h3>
    <table class="table table-bordered" > 
        <thead class="thead-dark">
            <tr>
                <th>Order #</th>
                <th>Expected Shipping date</th>
                <th>Country</th>
                <th>City</th>
                <th>Street</th>
                <th>Customer Phone Number</th>
                <th>Submit Order</th>
            </tr>
        </thead>';

    $sql = 'SELECT OID, OrderDate,DATE_ADD(OrderDate, INTERVAL 7 DAY) as ED,CID FROM Orders WHERE ShippingDate IS Null AND EID='.$GLOBALS['thisEmployee'];
    $result = mysqli_query($conn, $sql);
  //  echo $sql;

  //SELECT *
    while($row = mysqli_fetch_assoc($result)) {

        $sql = 'SELECT * FROM customer WHERE CID='.$row["CID"];
        $cinfo = mysqli_query($conn, $sql);
        $crow = mysqli_fetch_assoc($cinfo);
      //  echo $crow["Country"];

        echo "<tr><td>" . $row["OID"]. " </td><td> ".$row["ED"]."</td><td>".$crow["Country"]."</td><td>".$crow["City"]."</td><td>".$crow["Street"]."</td><td>".$crow["Phone"]."</td>";
        echo'<form action="AGHRADI.php" method="post">
        <td style="padding: 0; position: relative;">
        <button type="submit" name=SubmitOrder value='.$row["OID"].' class="btn btn-primary fullHeight" " onclick="SubmitOrder(ONumber)">Submit</button>
        </form></td>';
    }
    
    echo '</table><br></div>';

    $conn -> close();
}

function GetNotCollectedOrders(){
    GetActiveAccount();
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo '  <div class="Container" id=NotCollected>
    <h3>Orders to be collected</h3>
    <table class="table table-bordered"> 
    <thead class="thead-dark">
        
        <tr>
            <th>Order #</th>
            <th>Ordered Date</th>
            <th>Expected Shipping date</th>
            <th>Take Order</th>
        </tr>
        <tr>
        </thead> ';

    $sql = "SELECT OID, OrderDate,DATE_ADD(OrderDate, INTERVAL 7 DAY) as ED FROM Orders WHERE EID IS Null";
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["OID"]. " </td><td> ".$row["OrderDate"]. " </td><td> ".$row["ED"]."</td>";
        echo'<form action="AGHRADI.php" method="post">
        <td style="padding: 0px; position: relative;">
        <button type="submit" name=CollectOrder value='.$row["OID"].' class="btn btn-primary fullHeight" >+</button>
        </td></form>';
    }
    
    echo '</table><br></div>';

    $conn -> close();
}

function GetParts(){
    
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo'<div class="Container" id="Parts">
    <h3>Parts</h3>
    <table class="table table-bordered" > 
        <thead class="thead-dark">
            <tr>
                <th>Part #</th>
                <th>Part Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Image Path</th>
                <th>Remove Part</th>
            </tr>
        </thead>';    

    $sql = "SELECT * FROM Parts";
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr ><td>" . $row["PID"]."</td><td>".$row["PartName"]."</td><td>".$row["Price"]."</td>";

        echo' <form action="AGHRADI.php" method="post">';
        
       echo' <td style="position: relative; width: 180px;">';
       echo' <button  value='.$row["PID"].' name="Quantity--"  type="submit" class="btn btn-light" style="border-radius: 0px; display: inline; position:absolute; left: 0; top: 0; width: fit-content;" >-</button>';
       echo $row["Quantity"];
       echo'<button  value='.$row["PID"].'  name="Quantity++"   type="submit" class="btn btn-light" style="border-radius: 0px; display: inline; position:absolute; right: 0; top: 0; width: fit-content;">+</button></td>';
        echo"</td><td>".$row["PartDescription"]."</td><td>".$row["ImageSrc"]."</td>";
       echo'<td style="padding: 0px; position: relative;"><button type="submit" name="RemovePart" value="'.$row["PID"].'" type="submit" class="btn btn-primary fullHeight" >Remove Part</button></td></form></tr>';
    }
    
    
    echo '<form action="AGHRADI.php" method="post">
    <tr>
            <td></td>
            <td><input type="text" name=PartName required></td>
            <td><input type="number" name=Price required min="1"></td>
            <td><input type="number" name=Quantity required min="0"></td>
            <td><input type="text" name=Description></td>
            <td><input type="text" name=ImageSrc></td>

            <td style="padding: 0px; position: relative;"><button type="submit" name=AddPart  class="btn btn-primary fullHeight" >Add Part</button></td>

        </tr>
    </form>
    </table><br></div>';

    $conn -> close();
}

function GetMyCart(){
   
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo'<div class="Container" id="Parts">
    <h3>My Cart</h3>
    <table class="table table-bordered" > 
        <thead class="thead-dark">
            <tr>
                <th>Part Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Remove Part</th>
            </tr>
        </thead>';    

    $sql = "SELECT * FROM cart where CID=".$GLOBALS['thisCustomer'];
    $result = mysqli_query($conn, $sql);
    $Empty=true;
    while($row = mysqli_fetch_assoc($result)) {
        $Empty=false;
        $sql = "SELECT * FROM Parts where PID=".$row["PID"];
        $presult = mysqli_query($conn, $sql);
        $prow = mysqli_fetch_assoc($presult);

        echo "<tr class=thisItem><td>".$prow["PartName"]."</td>";

        echo' <form action="AGHRADI.php" method="post">';
        
       echo' <td style="position: relative; width: 180px;">';
       echo' <button  value='.$row["PID"].' name="QuantityCart--"  type="submit" class="btn btn-light" style="border-radius: 0px; display: inline; position:absolute; left: 0; top: 0; width: fit-content;" >-</button>';
       echo $row["Quantity"];
       echo'<button  value='.$row["PID"].'  name="QuantityCart++"   type="submit" class="btn btn-light" style="border-radius: 0px; display: inline; position:absolute; right: 0; top: 0; width: fit-content;">+</button></td>';
       
       echo'<td>'.$prow["Price"]*$row["Quantity"].'$</td>';
       echo'<td style="padding: 0px; position: relative;"><button type="submit" name="RemoveItem" value="'.$row["PID"].'" type="submit" class="btn btn-primary fullHeight">Remove Item</button></td></form></tr>';
    }

    if(!$Empty){
        echo '<tr><form action="AGHRADI.php" method="post"><td colspan=4 style="padding: 0px; position: relative;"><button type="sumbit" name=PlaceOrder Value='.$GLOBALS['thisCustomer'].' class="btn btn-primary" >Place Order!</button> </td></tr></form>';
    }
    
    echo'</table><br></div>';

    $conn -> close();
}
function GetOrdersInfo(){
  
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo '<div class="Container">
    <h3>Orders Information</h3>
    <table class="table table-bordered" > 
        <thead class="thead-dark">
            <tr>
                <th>Order #</th>
                <th>Part #</th>
                <th>Quantity</th>
            </tr>
        </thead>';    

    $sql = "SELECT * FROM `orderdetails` ORDER BY `orderdetails`.`OID` ASC";
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["OID"]. " </td><td> ".$row["PID"]." </td><td>" .$row["Quantity"]."</td>";
    }
    
    echo '</table><br></div>';

    $conn -> close();
}

function GetOptions(){
  
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM Parts";
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)) {
        
        echo' <div class="Parts">
         <div class=section1>';
        echo'<img src="'.$row["ImageSrc"].'" alt="'.$row["PartName"].'">';
        echo'</div><div class=section2>';

        echo'<h3>'.$row["PartName"].'</h3>';
        echo'<p>'.$row["PartDescription"].'</p>';
        echo'<h4>'.$row["Price"].'$</h4>';
   echo' </div>
    <div class=section3>
     <form action="AGHRADI.php" method="post">
            <input type="number" value="1" name=Quantity min="1">
            <input type="hidden" value="'.$row["PID"].'" name=ProductNumber>

            <button class="btn btn-info btn-lg" type="submit" name=AddToCart>
                <span class="glyphicon glyphicon-shopping-cart"><br><span>Add to cart</span></span>                    
            </button>
        </form>
    </div>
    </div>';

       // echo "<tr><td>" . $row["OID"]. " </td><td> ".$row["PID"]." </td><td>" .$row["Quantity"]."</td>";
    }
    
   
    $conn -> close();
}

function GetOrders(){
   
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo '<div class="Container">
    <h3>Orders</h3>
    <table class="table table-bordered" > 
        <thead class="thead-dark">
            <tr>
                <th>Order #</th>
                <th>Order date</th>
                <th>Ordered by</th>
                <th>Delivered by</th>
                <th>Order Statues</th>
                <th>Shipping Date</th>
            </tr>
        </thead>';
        
        
    $sql = "SELECT * FROM Orders";
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)) {
        $CustomerName="Unknown Customer";
        
        $sql = "SELECT * FROM customer where cid=".$row["CID"];
        if($cname = mysqli_query($conn, $sql)){
           $crow = mysqli_fetch_assoc($cname);

           $CustomerName= $crow['FirstName']." ". $crow["LastName"];
       }
      
      
    
        // }
        $EmployeeName="";
        $sql = "SELECT CID FROM isemployee where EID=".$row["EID"];
        if($ecid = mysqli_query($conn, $sql)){

            $ecidrow = mysqli_fetch_assoc($ecid);
            
            $sql = "SELECT * FROM customer where cid=".$ecidrow["CID"];
            $ename = mysqli_query($conn, $sql);
            $erow = mysqli_fetch_assoc($ename);
            $EmployeeName=$erow["FirstName"]." ". $erow["LastName"];
        }

        if($row["EID"]==null){
            $EmployeeName=null;
            $OrderStatues="Waiting to be collected";
        }
        else if($row["ShippingDate"]==null){
            $OrderStatues="Order is being delivered";
        }

        if($row["ShippingDate"]!=null){
            $OrderStatues="Order was submited";
        }

        echo "<tr><td>" . $row["OID"]. " </td><td> ".$row["OrderDate"]." </td><td>" .$CustomerName. "</td><td>".$EmployeeName."</td><td class=Statues>".$OrderStatues."</td><td>".$row["ShippingDate"]."</td>";
    }
    
    echo '</table><br></div>';

    $conn -> close();
}

function GetEmployess(){
    
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo'<div class="Container" id=Employee>
    <h3>Employee Table</h3>
    <table class="table table-bordered" > 
        <thead class="thead-dark">
            <tr>
                <th>EID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Remove Employee</th>
            </tr>
        </thead>';


    $sql = "SELECT * FROM isemployee";
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)) {

        $sql = "SELECT FirstName,LastName,Phone,Email FROM customer where cid=".$row["CID"];
        $q = mysqli_query($conn, $sql);
        $emp = mysqli_fetch_assoc($q);

        echo "<tr><td>" . $row["EID"]. " </td><td> ".$emp["FirstName"]." ". $emp["LastName"]." </td><td>" .$emp["Phone"]." </td><td>" .$emp["Email"]."</td>";

        //echo "<tr><td>" . $row["CID"]. " </td><td> ".$row["FirstName"]." ". $row["LastName"]." </td><td>" .$row["Email"]."</td>";
        echo' <form action="AGHRADI.php" method="post"><input type="hidden" name="RemoveEmployee" value="'.$row["EID"].'"><td style="padding: 0; position: relative;"><button type="submit" class="btn btn-primary fullHeight" style="border-radius: 0px;">-</button></td></form></tr>';
    }
    
    echo '</table><br></div>';

    $conn -> close();
}

if(isset($_POST['RemoveCustomer'])) {
    
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sl = 'DELETE FROM `customer` WHERE cid='.$_POST['RemoveCustomer'].';';
     mysqli_query($conn, $sl);
    // echo $cid;

  header("Refresh:0; url=Admin.php#Customer");
    $conn -> close();
}

if(isset($_POST['RemoveEmployee'])) {
    
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sl = 'DELETE FROM `isemployee` WHERE EID='.$_POST['RemoveEmployee'].';';
     mysqli_query($conn, $sl);
     //echo $_POST['RemoveEmployee'];
     //echo $sl;

     header("Refresh:0; url=Admin.php#Employee");
    $conn -> close();
}

if(isset($_POST['RemovePart'])) {
   
    //echo $_POST['RemovePart'];

    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sl = 'DELETE FROM `Parts` WHERE PID='.$_POST['RemovePart'].';';
    mysqli_query($conn, $sl);
    
    echo $sl;
     header("Refresh:0; url=Admin.php#Parts");
    $conn -> close();
}

if(isset($_POST['RemoveItem'])) {
   
    //echo $_POST['RemovePart'];

    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sl = 'DELETE FROM `Cart` WHERE PID='.$_POST['RemoveItem'].';';
    mysqli_query($conn, $sl);
    
   // echo $sl;
   header("Refresh:0; url=MyCart.php");
   $conn -> close();
}

if(isset($_POST['Quantity++'])) {
    //echo $_POST['RemovePart'];
   // echo "test";
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sl = 'UPDATE Parts SET Quantity=Quantity+1 WHERE PID='.$_POST['Quantity++'].';';
    //echo $sl;

    mysqli_query($conn, $sl);
    
     header("Refresh:0; url=Admin.php#Parts");
    $conn -> close();
}

if(isset($_POST['Quantity--'])) {
   
    //echo $_POST['RemovePart'];
    //echo "test";
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sl = 'UPDATE Parts SET Quantity=Quantity-1 WHERE PID='.$_POST['Quantity--'].';';
    //echo $sl;

    mysqli_query($conn, $sl);
    
     header("Refresh:0; url=Admin.php#Parts");
    $conn -> close();
}

if(isset($_POST['AddPart'])) {
    
  
    $PID='Null';
    $PartName=$_POST['PartName'];
    $Price=$_POST['Price'];
    $Quantity=$_POST['Quantity'];
    $Description=$_POST['Description'];
    $ImageSrc=$_POST['ImageSrc'];

    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sl = 'INSERT INTO `parts`(`PID`, `PartName`, `Price`, `Quantity`, `PartDescription`, `ImageSrc`) VALUES ('.$PID.',"'. $PartName.'",'.$Price.','.$Quantity.',"'.$Description.'","'.$ImageSrc.'")';
       echo $sl;

    mysqli_query($conn, $sl);
    
     header("Refresh:0; url=Admin.php#Parts");
    $conn -> close();
}

if(isset($_POST['AddToCart'])) {
   
 // echo'test';
 GetActiveAccount();
    $PID=$_POST['ProductNumber'];
    $Quantity=$_POST['Quantity'];
    
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //$YES=true;
    if(inStock($PID,$Quantity)){
            $sl = 'SELECT * FROM Cart WHERE CID='.$GLOBALS['thisCustomer'].' AND PID='. $PID.';';
            // echo $YES;
            $YES=mysqli_query($conn, $sl);
        //echo $YES;
        
        if($row = mysqli_fetch_assoc($YES)){
            $sl = 'UPDATE Cart SET Quantity=Quantity+'.$Quantity.' WHERE PID='. $PID.';';
            mysqli_query($conn, $sl);
        }
        else{
            
            $sl = 'INSERT INTO `cart`(`CID`, `PID`, `Quantity`) VALUES ('.$GLOBALS['thisCustomer'].','.$PID.','.$Quantity.');';
           // echo $sl;
            mysqli_query($conn, $sl);
            
        }   
    }
    header("Refresh:0; url=OrderNow.php");
    $conn -> close();
}

if(isset($_POST['CollectOrder'])) {
   
    //echo $_POST['RemovePart'];
    // echo "test";
    // echo $GLOBALS['thisEmployee'];

    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sl = 'UPDATE Orders SET EID='.$GLOBALS['thisEmployee'].' WHERE OID='.$_POST['CollectOrder'].';';
    //echo $sl;

    mysqli_query($conn, $sl);
    
     header("Refresh:0; url=Dashboard.php");
    $conn -> close();
}

if(isset($_POST['SubmitOrder'])) {
    
    //echo $_POST['RemovePart'];
    // echo "test";
    // echo $GLOBALS['thisEmployee'];

    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sl = 'UPDATE Orders SET ShippingDate=CURRENT_DATE WHERE OID='.$_POST['SubmitOrder'].';';
   // echo $sl;

    mysqli_query($conn, $sl);
    
    header("Refresh:0; url=Dashboard.php");
    $conn -> close();
}

if(isset($_POST['PlaceOrder'])) {
   
  

    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sl = 'INSERT INTO `orders`(`OrderDate`, `CID`) VALUES (CURRENT_DATE,'.$_POST['PlaceOrder'].')';
    mysqli_query($conn, $sl);

    $sql = "SELECT MAX(OID) AS OID FROM orders";
    $oresult = mysqli_query($conn, $sql);
    $orow = mysqli_fetch_assoc($oresult);
    
    $sql = "SELECT * FROM cart where cid=".$_POST['PlaceOrder'];
   // echo $_POST['PlaceOrder'];
    $result = mysqli_query($conn, $sql);

    
    
    while($row = mysqli_fetch_assoc($result)) {
        if(inStock($row["PID"],$row["Quantity"])){
                
            $sl='INSERT INTO `orderdetails`(`OID`, `PID`, `Quantity`) VALUES ('.$orow["OID"].','.$row["PID"].','.$row["Quantity"].')';
            mysqli_query($conn, $sl);
            
            $sl = 'UPDATE Parts SET Quantity=Quantity-'.$row["Quantity"].' WHERE  PID='.$row["PID"].';';
            mysqli_query($conn, $sl);

            $sl='DELETE FROM cart WHERE PID='.$row["PID"].' AND CID='.$_POST['PlaceOrder'];
            mysqli_query($conn, $sl);
        }
    }
        
        // echo $sl;
        
     header("Refresh:0; url=MyCart.php");
    $conn -> close();
}

if(isset($_POST['QuantityCart++'])) {
    
    //echo $_POST['RemovePart'];
   // echo "test";
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Quantity FROM cart where PID=".$_POST['QuantityCart++']." AND cid=".$GLOBALS['thisCustomer'];
    $cresult = mysqli_query($conn, $sql);
    $crow = mysqli_fetch_assoc($cresult);

    if(inStock($_POST['QuantityCart++'],$crow["Quantity"]+1)){
        $sl = 'UPDATE cart SET Quantity=Quantity+1 WHERE CID='.$GLOBALS['thisCustomer'].' AND PID='.$_POST['QuantityCart++'].';';
        mysqli_query($conn, $sl);
    }
    
    header("Refresh:0; url=MyCart.php");
    $conn -> close();
}

if(isset($_POST['QuantityCart--'])) {
  
    //echo $_POST['RemovePart'];
    //echo "test";
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sl = 'UPDATE cart SET Quantity=Quantity-1 WHERE CID='.$GLOBALS['thisCustomer'].' AND PID='.$_POST['QuantityCart--'].';';
    //echo $sl;

    mysqli_query($conn, $sl);
    
     header("Refresh:0; url=MyCart.php");
    $conn -> close();
}

if(isset($_POST['JoinTeam'])) {
  
    $conn= new mysqli("localhost","root","", "AGHRADI");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sl = 'INSERT INTO `isEmployee`(`CID`) VALUES ('.$GLOBALS['thisCustomer'].');';
    //echo $sl;
    mysqli_query($conn, $sl);
    
     header("Refresh:0; url=dashboard.php");
    $conn -> close();
}

if(isset($_POST['Login'])) {
    

    if($_POST['Username']=="Admin"){
        header("Refresh:0; url=Login.php");
    }
    else{

        $conn= new mysqli("localhost","root","", "AGHRADI");
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT CID FROM login WHERE Username='".$_POST['Username']."' AND Password=".$_POST['Password'];
    $cresult = mysqli_query($conn, $sql);
    if($crow = mysqli_fetch_assoc($cresult)){
        
        $GLOBALS['thisCustomer']=$crow["CID"];
        
        header("Refresh:0; url=OrderNow.php");
        
        $sl = 'DELETE FROM `ActiveAccount`';
        mysqli_query($conn, $sl);
        
        $sl = 'INSERT INTO `ActiveAccount`(`CID`) VALUES ('.$crow["CID"].')';
        mysqli_query($conn, $sl);
    }
    else{
        $GLOBALS['thisCustomer']=NULL;
        header("Refresh:0; url=Login.php");
    }
    
    
    $conn -> close();
}
}

if(isset($_POST['SignUP'])) {
   
    $conn= new mysqli("localhost","root","", "AGHRADI");
    
    
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sl = 'INSERT INTO `customer`(`FirstName`, `LastName`, `Phone`, `Country`, `City`, `Street`, `Email`) VALUES ("'.$_POST['FirstName'].'","'.$_POST['LastName'].'",'.$_POST['Phone'].',"'.$_POST['Country'].'","'.$_POST['City'].'","'.$_POST['Street'].'","'.$_POST['Email'].'")';
    mysqli_query($conn, $sl);

    $sql = "SELECT MAX(`CID`) AS CID FROM customer";
    $cresult = mysqli_query($conn, $sql);
    $crow = mysqli_fetch_assoc($cresult);

    $sl = 'INSERT INTO `login`(`CID`, `Username`, `Password`) VALUES ('.$crow["CID"].',"'.$_POST['Username'].'","'.$_POST['Password'].'")';
    mysqli_query($conn, $sl);
    echo $sl;
    
    $sl = 'DELETE FROM `ActiveAccount`';
    mysqli_query($conn, $sl);

    $sl = 'INSERT INTO `ActiveAccount`(`CID`) VALUES ('.$crow["CID"].')';
    mysqli_query($conn, $sl);

     header("Refresh:0; url=OrderNow.php");
    $conn -> close();
}

?>