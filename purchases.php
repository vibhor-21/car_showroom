<?php
session_start();
if(!isset($_SESSION['empid'])) {
    header('location:emplogin.php');
}
?>

<!DOCTYPE html>
<head>
<title>
   Pending Purchase Requests</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="css/global3.css">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body class="bg">
       <br><?php  
        if(isset($_POST['submit'])) {
            $_SESSION['purmail']=$_POST['submit'];
            header('location:finalpurchase.php');
        }
    ?>
       <p>
       <ul>
   <li><a href="emphome.php">HOME</a></li>
   <li><a href="empdashboard.php">DASHBOARD</a></li>
   <li><a href="sales.php">SALES</a></li>
   <li><a href="pur.php">PURCHASES</a></li>
   <li> <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1></li>
   <li><a href="emplogout.php"> LOGOUT </a></li>
   </ul>
   </p>
   <h1 align='center' class="heading"><font color='white'>PENDING PURCHASE REQUESTS:</font></h1><br>

<p>
<div class="gallery">
<?php
    $i=0;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbms";

    $conn = new mysqli($servername, $username, $password, $dbname);
        
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql1 = "SELECT * FROM cart WHERE status='2'";
    $result1 = mysqli_query($conn,$sql1);
    while($row1 = $result1->fetch_assoc()) {
        $flag1=0;
        for($j=0;$j<$i;$j++)
    {
        if($row1['owner_id']==$users[$j]) {
            $flag1=1;
            break;
        }
    }
        if($flag1==0)
    {
        $users[$i]=$row1['owner_id'];
        $i+=1;
    }
    }

    for($j=0;$j<$i;$j++) {
        $sql = "SELECT * FROM usertable WHERE email='$users[$j]'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['fname']!='admin') {
                echo "<figure><img src='images/person1.png'><figcaption><b>Name:</b> ".$row['fname']." ".$row['lname']."<br><b>Email:</b> ".$row['email']."
                <br><b>Phone No.:</b> ".$row['phoneno']."<br><br><form method='post' name='delete'><button type='submit' name='submit' class='btn btn-primary btn-block' value='".$row['email']."'>View Cart</button></form></figcaption></figure> ";
                }
            }
        } else {
            echo "<h2 align='center'><font color='white'>No Customers Inserted</font></h2>";
        }
    }
        $conn->close();
?>
</div>
</p>
</body>
</html>