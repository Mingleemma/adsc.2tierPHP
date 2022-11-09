<?php
    $link = new mysqli("localhost:3308", "root", "1200secs", "adsc22");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Initializing variables
        

        $email = $_POST['email'];
        $email = mysqli_real_escape_string($link, $email);

        $username = $_POST['username'];
        $username = mysqli_real_escape_string($link, $username);

    
        $sql_insertregdetails = "INSERT INTO 2tierphp (name, email, date_registered) VALUES('$username', '$email', now())";
        $success_insertregdetails = mysqli_query($link, $sql_insertregdetails);
        if ($success_insertregdetails) {
            $lastid = mysqli_insert_id($link);
            header("location:index.php?alert('We did it')");
        }
        else{
            echo "Error";
            echo mysqli_error($link);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple 2-Tier Application</title>
    <style>
        table, td, th {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body bgcolor="lavendar">
    <center><h1>Welcome to the Simple 2-Tier Application</h1></center>
    <center>
        <form action="index.php" method="POST">
            <div>
                <input type="text" placeholder="Enter your name here" name="username"><br><br>
                <input type="text" placeholder="Enter your email here" name="email" type="email"><br><br>
                <button type="submit">submit</button>
            </div>
        </form>
    </center>

    <br><br><br>
    <center><table>
        <thead>
        <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date Registered</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //Displaying details of registration from database
        $sql_retrievedetails = "SELECT * from 2tierphp";
        $success_retrievedetails = mysqli_query($link, $sql_retrievedetails);
        if ($success_retrievedetails->num_rows > 0) {
            $i = 1;
            while ($row = $success_retrievedetails->fetch_assoc()) {
                ?>
                <tr>
                    <th><?php echo $row['name'];?></th>
                    <th><?php echo $row['email']; ?></th>
                    <th><?php echo $row['date_registered']; ?></th>
                </tr>
                <?php
            }
            $i++;
        }
        ?>
        </tbody>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date Registered</th>
            </tr>
        </thead>
    </table><center>
</body>
</html>