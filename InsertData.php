<!DOCTYPE html>
<html>
<script>
    function CheckClass() {
        var CheckClassName = document.getElementById("Class1").value;
        var checkFullName = document.getElementById("Name1").value;
        var checkEmail = document.getElementById("Email1").value;
        if (CheckClassName == "GCD0821") {
            return true;
        } else if (checkFullName == "") {
            alert("FullName should have Data");
            return false;
        } else if (checkEmail == "") {
            alert("Email should have Data");
            return false;
        } else {
            alert("ClassName should equal GCD0821");
            return false;
        }
    }
</script>

<head>
    <title>Insert data to PostgreSQL with php - creating a simple web application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="style.css">
    <style>
        li {
            list-style: none;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <h1>INSERT DATA TO DATABASE</h1>
    <h2>Enter data into student table</h2>
    <ul>
        <form name="InsertData" action="InsertData.php" method="POST">
            <li>Product ID:</li>
            <li><input type="text" name="stuid" /></li>
            <li>Full Name:</li>
            <li><input type="text" name="fname" id="Name1" /></li>
            <li>Price:</li>
            <li><input type="text" name="email" id="Email1" /></li>
            <li>Supplier:</li>
            <li><input type="text" name="classname" id="Class1" /></li>
            <li><input type="submit" name="Submit" onclick="CheckClass()" /></li>
        </form>
    </ul>
    <div class="row">
        <div class="col-12">
            <a href="ConnectToDB.php" class="myButton pl-3">View Data</a>

            <a href="UpdateData.php" class="myButton pl-3">Update data to the database</a>

            <a href="DeleteData.php" class="myButton pl-3">Delete data to the database</a>
        </div>
    </div>
    <?php

    if (empty(getenv("DATABASE_URL"))) {
        echo '<p>The DB does not exist</p>';
        $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
    } else {

        $db = parse_url(getenv("DATABASE_URL"));
        $pdo = new PDO("pgsql:" . sprintf(
         "host=ec2-54-235-167-210.compute-1.amazonaws.com;
	  port=5432;
      user=mykyomtigjilmn;
      password=d112d6d9924157dde67191b6bb9b7e9dc5da2dbf8f442700a06d9176f7633996;
      dbname=d6ov8csheb765b",
            $db["host"],
            $db["port"],
            $db["user"],
            $db["pass"],
            ltrim($db["path"], "/")
        ));
    }

    if ($pdo === false) {
        echo "ERROR: Could not connect Database";
    }

    
    $sql = "INSERT INTO student(stuid, fname, email, classname)"
        . " VALUES('$_POST[stuid]','$_POST[fname]','$_POST[email]','$_POST[classname]')";
    $stmt = $pdo->prepare($sql);
    
    if (is_null($_POST[stuid])) {
        echo "StudentID must be not null";
    } else {
        if ($stmt->execute() == TRUE) {
            echo "Record inserted successfully.";
        } else {
            echo "Error inserting record: ";
        }
    }
    ?>
</body>

</html>
