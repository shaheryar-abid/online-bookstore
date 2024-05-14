<?php
    include 'Connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <ol style = "background-color: coral">
    <title>Movie Store</title>
    <style>
        body {
            text-align: center;
            margin: 0;
            padding: 0;
            font-family: 'Monaco', Monospace; /* Change the font here */
        }
    </style>
</head>
<body>

    <h1> Online Movie Store</h1>
    </body>
</html>
    <br>

<img src="https://www.centenarycentre.com/wp-content/uploads/2015/07/movie-film-clip-art-movies.gif"

<br><br>
    <?php

    if(!$conn){
        echo"connection failed";
    }//else { echo "connected";}

    if(isset($_POST["D1"])){
        try{
         if($conn->query("Drop table Movie;")=== true) {
            echo"<center><b>\n \nDropped  Movie Table \n \n</b></center>";
        }}catch(Exception $e){
            echo "error table does not exist";}
        $conn->close();
    }
    if(isset($_POST["C1"])){
        try{
        if($conn->query("CREATE TABLE MOVIE( movieId INT, movieName VARCHAR(25), moviePrice INT, PRIMARY KEY (movieId), genre VARCHAR(25));")===TRUE) {
            echo"<center><b>\n \nCreated Movie Table \n \n</b></center>";
        }}catch(Exception $e){
            echo "table already exists";
        }
        $conn->close();

    }
    if(isset($_POST["P1"])){
        try{
        if($conn->multi_query("INSERT INTO MOVIE(movieId,movieName,MoviePrice,genre) VALUES (1,'Barbie',10,'comedy');") ===TRUE) {
            echo"<center><b>\n \nPopulated Movie Table \n \n</b></center>";
        }}catch(Exception $e){
            echo "error";
        }
        $conn->close();

    }
    if(isset($_POST["Q1"])){
        echo"<center><b>\n \nQueried Movie Table \n \n</b></center>";
        try{
        $sql="SELECT movieId, movieName, moviePrice, genre FROM Movie";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "Movie ID: " . $row["movieId"]. "   |    Movie Name: " . $row["movieName"]. "    |    Genre: ". $row["genre"]. "<br>";
        }
    }else{
        echo"No Results";
    }
}catch(Exception $e){
    echo "Not data to query";
   }
    $conn->close();
   }

   if(isset($_POST["S1"])){
    include 'SetMovie.php';
    include 'Connection.php';
    $movieId01 = $_GET['movieId1'];
    $movieName01 = $_GET['movieName1'];
    $price01 = $_GET['price1'];
    $genre01 = $_GET['genre1'];
    $sql ="insert into Movie(movieId, movieName, moviePrice, genre) Values ('$movieId01', '$movieName01', '$price01','$genre01');";
    mysqli_query($conn, $sql);

   }                

   if(isset($_POST["D2"])){
    try{
     if($conn->query("Drop table Shopping Cart;")=== true) {
        echo"<center><b>\n \nDropped Shopping Cart Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error table does not exist";}
    $conn->close();
}
if(isset($_POST["C2"])){
    try{
    if($conn->query("create table Shopping Cart (movieId int references Movie(movieId), int orderId, int customerId, moviePrice int references Movie(moviePrice));")===TRUE) {
        echo"<center><b>\n \nCreated Shopping Cart Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "table already exists";
    }
    $conn->close();

}
if(isset($_POST["P2"])){
    try{
    if($conn->multi_query("insert into Shopping Cart values (2,4 , 123,10);
    insert into Shopping Cart values (3, 5, 124, 15);")===TRUE) {
        echo"<center><b>\n \nPopulated Shopping Cart Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error";
    }
    $conn->close();

}
if(isset($_POST["Q2"])){
    echo"<center><b>\n \nQueried Shopping Cart Table \n \n</b></center>";
    try{
    $sql="SELECT  	movieId, 	orderId ,	customerId, moviePrice ";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "movieId: " . $row["movieId"]. "   |    orderId: " . $row["orderId"]. "    |    customerId: ". $row["customerId"]. "|    moviePrice: ". $row["moviePrice"]. "<br>";
    }
}else{
    echo"No Results";
}
}catch(Exception $e){
echo "Not data to query";
}
$conn->close();
}

   if(isset($_POST["S2"])){
    include 'SetShoppingCart.php';
    include 'Connection.php';
    global $movieID02, $orderID02, $customerID02, $movieprice02;
    $movieID02 = $_GET['movieId1'];
    $orderID02 = $_GET['orderId1'];
    $customerID02 = $_GET['customerId1'];
    $movieprice02 = $_GET['moviePrice1'];
    $sql ="insert into ShoppingCart(movieId, orderId, customerId,moviePrice) Values ('$movieID02', '$orderID02', '$customerID02','$movieprice02');";
    mysqli_query($conn, $sql);

   }

if(isset($_POST["D3"])){
    try{
     if($conn->query("Drop Wishlist;")=== true) {
        echo"<center><b>\n \nDropped Wishlist Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error table does not exist";}
    $conn->close();
}
if(isset($_POST["C3"])){
    try{
    if($conn->query(" create table Wishlist (wishlistId int, movieId   int, username  VARCHAR(25));")===TRUE) {
        echo"<center><b>\n \nCreated Wishlist Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "table already exists";
    }
    $conn->close();

}
if(isset($_POST["P3"])){
    try{
    if($conn->multi_query("insert into Wishlist values (2, 3, JimmyBuckets);
    insert into Wishlist values (23, 22, greekfreak);")===TRUE) {
        echo"<center><b>\n \nPopulated Wishlist Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error";
    }
    $conn->close();

}
if(isset($_POST["Q3"])){
    echo"<center><b>\n \nQueried Wishlist Table \n \n</b></center>";
    try{
    $sql="SELECT  	wishlistId, 	customer_ID, username ;";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "WishlistId : " . $row["wishlistId"]. "   |    movieId : " . $row["movieId"]. "|    username : " . $row["username"]. "<br>";
    }
}else{
    echo"No Results";
}
}catch(Exception $e){
echo "Not data to query";
}
$conn->close();
}
if(isset($_POST["S3"])){
    include 'SetWishlist.php';
    include 'Connection.php';
    $WishlistId03 = $_GET['WishlistId3'];
    $movieId03 = $_GET['movieId3'];
    $username03 = $_GET['username3'];
    $sql ="insert into Wishlist(wishlistId, movieId, username) Values ('$WishlistId03', '$movieId03','$username03');";
    mysqli_query($conn, $sql);

   }

if(isset($_POST["D4"])){
    try{
     if($conn->query("Drop table Purchases;")=== true) {
        echo"<center><b>\n \nDropped Purchases Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error table does not exist";}
    $conn->close();
}
if(isset($_POST["C4"])){
    try{
    if($conn->query(" create table Purchases (customer_ID int references Customer(customer_ID), vacation_ID int references Vacation(vacation_ID), primary key(customer_ID, vacation_ID)); ")===TRUE) {
        echo"<center><b>\n \nCreated Purchases Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "table already exists";
    }
    $conn->close();

}
if(isset($_POST["P4"])){
    try{
    if($conn->multi_query("insert into Purchases values (10,1);
    insert into Purchases values (10,2);
    insert into Purchases values (10,3);
    insert into Purchases values (2345,1);
    insert into Purchases values (2345,2);
    insert into Purchases values (2345,3);
    insert into Purchases values (10,49);
    insert into Purchases values (369,50);")===TRUE) {
        echo"<center><b>\n \The Purchases Table was populated\n \n</b></center>";
    }}catch(Exception $e){
        echo "error";
    }
    $conn->close();

}
if(isset($_POST["Q4"])){
    echo"<center><b>\n \Purchases Table is queried\n \n</b></center>";
    try{
    $sql="SELECT  	customer_ID ,	purchase_ID";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "Customer ID: " . $row["customer_ID"]. "   |    Purchase ID: " . $row["purchase_ID"]. "<br>";
    }
}else{
    echo"No Results";
}
}catch(Exception $e){
echo "Not data to query";
}
$conn->close();
}
if(isset($_POST["S4"])){
    include 'SetPurchases.php';
    include 'Connection.php';
    $CustomerID04 = $_GET['CustomerID4'];
    $PurchaseID04 = $_GET['PurchaseID4'];
    $sql ="insert into Purchases(customer_Id, purchase_Id) Values ('$CustomerID04', '$PurchaseID04');";
    mysqli_query($conn, $sql);
}

if(isset($_POST["D5"])){
    try{
     if($conn->query("Drop table Customer;")=== true) {
        echo"<center><b>\n \nDropped Customer Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error table does not exist";}
    $conn->close();
}
if(isset($_POST["C5"])){
    try{
    if($conn->query(" create table Customer (customer_ID int primary key, customer_name varchar(30));")===TRUE) {
        echo"<center><b>\n \nCreated Customer Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "table already exists";
    }
    $conn->close();

}
if(isset($_POST["P5"])){
    try{
    if($conn->multi_query("insert into Customer values (1, 'Jimmy Butler ');
    insert into Customer values (2, 'Bryce Harper');
    insert into Customer values (3, 'Aubrey Graham');")===TRUE) {
        echo"<center><b>\n \nPopulated Customer Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error";
    }
    $conn->close();

}
if(isset($_POST["Q5"])){
    echo"<center><b>\n \nQueried Customer Table \n \n</b></center>";
    try{
    $sql="SELECT  	customer_ID, 	customer_name  	 FROM Customer";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "Customer ID: " . $row["customer_ID"]. "   |    Customer Name: " . $row["customer_name"]. "<br>";
    }
}else{
    echo"No Results";
}
}catch(Exception $e){
echo "Not data to query";
}
$conn->close();
}
if(isset($_POST["S5"])){
    include 'SetCustomer.php';
    include 'Connection.php';
    $CustomerID05 = $_GET['CustomerID5'];
    $CustomerName05 = $_GET['CustomerName5'];
    $sql ="insert into Customer(customer_ID, customer_name) Values ('$CustomerID05', '$CustomerName05');";
    mysqli_query($conn, $sql);

   }

if(isset($_POST["D6"])){
    try{
     if($conn->query("Drop table Genre;")=== true) {
        echo"<center><b>\n \nDropped Genre Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error table does not exist";}
    $conn->close();
}
if(isset($_POST["C6"])){
    try{
    if($conn->query("create table Genre (Genre varchar(30) primary key);")===TRUE) {
        echo"<center><b>\n \nCreated Genre Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "table already exists";
    }
    $conn->close();

}
if(isset($_POST["P6"])){
    try{
    if($conn->multi_query("insert into Genre values ('action');
    insert into Vacation values ('horror');
    insert into Vacation values ('comedy');
    insert into Vacation values ('romantic');
    insert into Vacation values ('thriller');")===TRUE) {
        echo"<center><b>\n \nPopulated Genre Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error";
    }
    $conn->close();

}
if(isset($_POST["Q6"])){
    echo"<center><b>\n \nQueried Genre Table \n \n</b></center>";
    try{
    $sql="SELECT genre FROM Genre";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "Genre: " . $row["genre"].  "<br>";
    }
}else{
    echo"No Results";
}
}catch(Exception $e){
echo "Not data to query";
}
$conn->close();}
if(isset($_POST["S6"])){
    include 'SetGenre.php';
    include 'Connection.php';
    $Genre06 = $_GET['Genre6'];
    $sql ="insert into Genre(genre) Values ('$Genre06');";
    mysqli_query($conn, $sql);
   }

if(isset($_POST["D7"])){
    try{
     if($conn->query("Drop table Catalog;")=== true) {
        echo"<center><b>\n \nDropped Catalog \n \n</b></center>";
    }}catch(Exception $e){
        echo "error table does not exist";}
    $conn->close();
}
if(isset($_POST["C7"])){
    try{
    if($conn->query("create table Catalog (catalog varchar(30));")===TRUE) {
        echo"<center><b>\n \nCreated Catalog \n \n</b></center>";
    }}catch(Exception $e){
        echo "table already exists";
    }
    $conn->close();

}
if(isset($_POST["P7"])){
    try{
    if($conn->multi_query("insert into Catalog values('Movies');")===TRUE) {
        echo"<center><b>\n \nPopulated Catalog Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error";
    }
    $conn->close();

}
if(isset($_POST["Q7"])){
    echo"<center><b>\n \nQueried Catalog Table \n \n</b></center>";
    try{
    $sql="SELECT catalogs FROM Catalog";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "Catalog: " . $row["catalogs"]. "<br>";
    }
}else{
    echo"No Results";
}
}catch(Exception $e){
echo "Not data to query";
}
$conn->close();
}
if(isset($_POST["S7"])){
    include 'SetCatalog.php';
    include 'Connection.php';
    $Catalog07 = $_GET['Catalog7'];
    $sql ="insert into Catalog(catalogs) Values ('$Catalog07');";
    mysqli_query($conn, $sql);

   }

if(isset($_POST["D8"])){
    try{
     if($conn->query("Drop table Account;")=== true) {
        echo"<center><b>\n \nDropped Account Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error table does not exist";}
    $conn->close();
}
if(isset($_POST["C8"])){
    try{
    if($conn->query("create table Account (username varchar(30), password varchar(30)); ")===TRUE) {
        echo"<center><b>\n \nCreated Account Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "table already exists";
    }
    $conn->close();

}
if(isset($_POST["P8"])){
    try{
    if($conn->multi_query("insert into Account values('jimmybuckets', 'heatculture');")===TRUE) {
        echo"<center><b>\n \nPopulated Account Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error";
    }
    $conn->close();

}
if(isset($_POST["Q8"])){
    echo"<center><b>\n \nQueried Account Table \n \n</b></center>";
    try{
    $sql="SELECT username  FROM Account";
    $sql="SELECT password  FROM Account";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "Account: " . $row["username"]. "<br>";
    }
}else{
    echo"No Results";
}
}catch(Exception $e){
echo "Not data to query";
}
$conn->close();
}   if(isset($_POST["S8"])){
    include 'SetAccount.php';
    include 'Connection.php';
    $username08 = $_GET['username8'];
    $sql ="insert into Account(username) value ('$username08');";
    mysqli_query($conn, $sql);


   }


if(isset($_POST["D9"])){
    try{
     if($conn->query("drop table Membership;")=== true) {
        echo"<center><b>\n \nDropped Membership Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error table does not exist";}
    $conn->close();
}
if(isset($_POST["C9"])){
    try{
    if($conn->query("create table Membership (customer_name varchar(30) primary key, int points); ")===TRUE) {
        echo"<center><b>\n \nCreated Membership Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "table already exists";
    }
    $conn->close();

}
if(isset($_POST["P9"])){
    try{
    if($conn->multi_query("insert into Membership values ('Jimmy Buttler', 22);")===TRUE) {
        echo"<center><b>\n \nPopulated Membership Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error";
    }
    $conn->close();

}
if(isset($_POST["Q9"])){
    echo"<center><b>\n \nQueried Membership Table \n \n</b></center>";
    try{
    $sql="SELECT customerName,  FROM Customer";
    $sql="SELECT points";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "Customer Name: " . $row["customerName"]. "   |    points: " . $row["points"]. "<br>";
    }
}else{
    echo"No Results";
}
}catch(Exception $e){
echo "Not data to query";
}
$conn->close();
}
if(isset($_POST["S9"])){
    include 'SetMembership.php';
    include 'Connection.php';
    $CustomerName09 = $_GET['CustomerName9'];
    $points09 = $_GET['points9'];
    $sql ="insert into Membership(customerName, points) Values ('$CustomerName09', '$points09');";
    mysqli_query($conn, $sql);
   }

if(isset($_POST["D10"])){
    try{
     if($conn->query("drop table Admin;")=== true) {
        echo"<center><b>\n \nDropped Admin Details \n \n</b></center>";
    }}catch(Exception $e){
        echo "error table does not exist";}
    $conn->close();
}
if(isset($_POST["C10"])){
    try{
    if($conn->query("create table Admin ( username varchar(30), password varchar(30)); ")===TRUE) {
        echo"<center><b>\n \nCreated Admin Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "table already exists";
    }
    $conn->close();

}
if(isset($_POST["P10"])){
    try{
    if($conn->multi_query("insert into Admin values ('jimmybuckets','swish22');")===TRUE) {
        echo"<center><b>\n \nPopulated Admin Table \n \n</b></center>";
    }}catch(Exception $e){
        echo "error";
    }
    $conn->close();

}
if(isset($_POST["Q10"])){
    echo"<center><b>\n \nQueried Admin Table \n \n</b></center>";
    try{
    $sql="SELECT username, password 	 FROM Admin";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "username: " . $row["username"]. "   |    password: " . $row["password"]. "<br>";
    }
}else{
    echo"No Results";
}
}catch(Exception $e){
echo "Not data to query";
}
$conn->close();
}
if(isset($_POST["S10"])){
    include 'SetAdmin.php';
    include 'Connection.php';
    $usernameID10 = $_GET['username10'];
    $password10 = $_GET['password10'];
    $sql ="insert into Agent_Details(username, password,) Values ('$usernameID10', '$password10');";
    mysqli_query($conn, $sql);


   }

    if(isset($_POST["E"])){
        echo"\n \n Exiting \n \n";
        
        echo "<script>window.close();</script>";
        exit();
    }
    
    ?>

    <form method="post">
    <H1>Movie Table</H1>
    <input type="submit" class="button" name="D1" value ="Drop Movie Table">
    <input type="submit" class="button" name="C1" value ="Create Movie Table">
    <input type="submit" class="button" name="P1" value ="Populate Movie Table">
    <input type="submit" class="button" name="S1" value ="Set Movie Table">
    <input type="submit" class="button" name="Q1" value ="Query Movie Table"><br> <br> <br>

    <H1>Shopping Cart Table</H1>
    <input type="submit" class="button" name="D2" value ="Drop Shopping Cart Table">
    <input type="submit" class="button" name="C2" value ="Create Shopping Cart Table">
    <input type="submit" class="button" name="P2" value ="Populate Shopping Cart Table">
    <input type="submit" class="button" name="S2" value ="Set Shopping Cart Table">
    <input type="submit" class="button" name="Q2" value ="Query Shopping Cart Table"><br> <br> <br>

    <H1>Wishlist</H1>
    <input type="submit" class="button" name="D3" value ="Drop Wishlist">
    <input type="submit" class="button" name="C3" value ="Create Wishlist">
    <input type="submit" class="button" name="P3" value ="Populate Wishlist">
    <input type="submit" class="button" name="S3" value ="Set Wishlist">
    <input type="submit" class="button" name="Q3" value ="Query Wishlist"><br> <br> 

    <H1>Purchases</H1>
    <input type="submit" class="button" name="D4" value ="Drop Purchases">
    <input type="submit" class="button" name="C4" value ="Create Purchases">
    <input type="submit" class="button" name="P4" value ="Populate Purchases">
    <input type="submit" class="button" name="S4" value ="Set Purchases">
    <input type="submit" class="button" name="Q4" value ="Query Purchases"><br> <br> <br>

    <H1>Customer</H1>
    <input type="submit" class="button" name="D5" value ="Drop Customer">
    <input type="submit" class="button" name="C5" value ="Create Customer">
    <input type="submit" class="button" name="P5" value ="Populate Customer">
    <input type="submit" class="button" name="S5" value ="Set Customer">
    <input type="submit" class="button" name="Q5" value ="Query Customer"><br> <br> <br>

    <H1>Genre</H1>
    <input type="submit" class="button" name="D6" value ="Drop Genre">
    <input type="submit" class="button" name="C6" value ="Create Genre">
    <input type="submit" class="button" name="P6" value ="Populate Genre">
    <input type="submit" class="button" name="S6" value ="Set Genre">
    <input type="submit" class="button" name="Q6" value ="Query Genre"><br> <br> <br>


    <H1>Catalog</H1>
    <input type="submit" class="button" name="D7" value ="Drop Catalog">
    <input type="submit" class="button" name="C7" value ="Create Catalog">
    <input type="submit" class="button" name="P7" value ="Populate Catalog">
    <input type="submit" class="button" name="S7" value ="Set Catalog">
    <input type="submit" class="button" name="Q7" value ="Query Catalog"><br> <br> <br>


    <H1>Account</H1>
    <input type="submit" class="button" name="D8" value ="Drop Account">
    <input type="submit" class="button" name="C8" value ="Create Account">
    <input type="submit" class="button" name="P8" value ="Populate Account">
    <input type="submit" class="button" name="S8" value ="Set Account">
    <input type="submit" class="button" name="Q8" value ="Query Account"><br> <br> <br>


    <H1>Membership</H1>
    <input type="submit" class="button" name="D9" value ="Drop Membership">
    <input type="submit" class="button" name="C9" value ="Create Membership">
    <input type="submit" class="button" name="P9" value ="Populate Membership">
    <input type="submit" class="button" name="S9" value ="Set Membership">
    <input type="submit" class="button" name="Q9" value ="Query Membership"><br> <br> <br>


    <H1>Admin</H1>
    <input type="submit" class="button" name="D10" value ="Drop Admin">
    <input type="submit" class="button" name="C10" value ="Create Admin">
    <input type="submit" class="button" name="P10" value ="Populate Admin">
    <input type="submit" class="button" name="S10" value ="Set Admin">
    <input type="submit" class="button" name="Q10" value ="Query Admin"><br> <br> <br>

    </form>
    
    </body> 
</head>
</html>
