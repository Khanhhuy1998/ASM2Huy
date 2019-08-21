<!DOCTYPE html>
<html>

<body>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <h1>DATABASE CONNECTION</h1>

  <?php
  ini_set('display_errors', 1);
  echo "HELLO CLOUD COMPUTING CLASS 0821!";

  ?>

  <?php


  if (empty(getenv("DATABASE_URL"))) {
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
  } else {
    echo '<p>The DB exists</p>';
    echo getenv("dbname");
    $db = parse_url(getenv("DATABASE_URL"));
    $pdo = new PDO("pgsql:" . sprintf(
      "host=ec2-54-235-167-210.compute-1.amazonaws.com;
	  port=5432;
      user=ykyomtigjilmn;
      password=d112d6d9924157dde67191b6bb9b7e9dc5da2dbf8f442700a06d9176f7633996;
      dbname=d6ov8csheb765b",
      $db["host"],
      $db["port"],
      $db["user"],
      $db["pass"],
      ltrim($db["path"], "/")
    ));
  }

  $sql = "SELECT * FROM student ORDER BY stuid";
  $stmt = $pdo->prepare($sql);
  //Thiết lập kiểu dữ liệu trả về
  $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $stmt->execute();
  $resultSet = $stmt->fetchAll();
  echo '<p>Students information:</p>';
  // foreach ($resultSet as $row) {
  // 	echo $row['stuid'];
  //         echo "    ";
  //         echo $row['fname'];
  //         echo "    ";
  //         echo $row['email'];
  //         echo "    ";
  //         echo $row['classname'];
  //         echo "<br/>";
  // }

  ?>

  <div class="widget-content nopadding">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Student ID</th>
          <th>Full Name</th>
          <th>Phone</th>
          <th>classname</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($resultSet as $key => $value) : ?>
          <tr class="odd gradeX">
            <td><?php echo $value['stuid']; ?></td>
            <td><?php echo $value['fname']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['classname']; ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="InsertData.php" class="myButton pl-3">Insert data to the database</a>

      <a href="UpdateData.php" class="myButton pl-3">Update data to the database</a>

      <a href="DeleteData.php" class="myButton pl-3">Delete data to the database</a>
    </div>
  </div>
</body>

</html>