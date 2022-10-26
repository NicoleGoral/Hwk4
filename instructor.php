<?php require_once("header.php"); ?>
<h1>Instructors</h1>
<!doctype html>
<html lang="en">

  <table class="table table-striped">
  <thead>
    <tr>
      <th>Instructor ID</th>
      <th>Instructor Name</th>
      <th>Course ID</th>
      <th>Section ID</th>
    </tr>
  </thead>
  <tbody>
<?php
$servername = "localhost";
$username = "ngoralou_homework3";
$password = "Createou!";
$dbname = "ngoralou_homework3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT instructorID, instructorName, courseID, sectionID FROM instructor";
$result = $conn->query($sql);
       
 if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {


        echo '<tr>              
                  <td scope="row">' . $row["instructorID"]. '</td>
                  <td>' . $row["instructorName"] .'</td>
                  <td>' . $row["courseID"] .'</td>
                  <td>' . $row["sectionID"] .'</td>
                  <td>
      <form method="post" action="instructorstudent.php">
        <input type="hidden" name="id" value="<?=$row["courseID"]?>
        <input type="submit" value="Students" />
      </form>
    </td>
                   <br>                
                </tr>';
    }
} else {
    echo "0 results";
} 
?>
       </tbody>    
      </table>
    </div>
</table>





<?php require_once("header.php"); ?>
<h1>Instructors</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Instructor ID</th>
      <th>Instructor Name</th>
      <th>Course ID</th>
      <th>Section ID</th>
    </tr>
  </thead>
  <tbody>
<?php
$servername = "localhost";
$username = "ngoralou_homework3";
$password = "Createou!";
$dbname = "ngoralou_homework3";
    
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into Customer (customer_name, employee_id, product_name, product_cost) value (?,?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sisi", $_POST['cName'], $_POST['eid'], $_POST['pName'], $_POST['pCost']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Customer added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Customer set customer_name=?, employee_id=?, product_name=?, product_cost=? where customer_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sisii", $_POST['cName'], $_POST['eid'], $_POST['pName'], $_POST['pCost'], $_POST['cid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Customer edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Customer where customer_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['cid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Customer deleted.</div>';
      break;
  }
}
?>         
<?php
$sql = "SELECT customer_id, customer_name, employee_id, product_name, product_cost FROM Customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["customer_id"]?></td>
            <td><?=$row["customer_name"]?></td>
            <td><?=$row["employee_id"]?></td>
            <td><?=$row["product_name"]?></td>
            <td><?=$row["product_cost"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editCustomer<?=$row["customer_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editCustomer<?=$row["customer_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCustomer<?=$row["customer_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editCustomer<?=$row["customer_id"]?>Label">Edit Customer</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editCustomer<?=$row["customer_id"]?>Name" class="form-label">Customer Name</label>
                          <input type="text" class="form-control" id="editCustomer<?=$row["customer_id"]?>Name" aria-describedby="editCustomer<?=$row["customer_id"]?>Help" name="cName" value="<?=$row['customer_name']?>">
                          <div id="editCustomer<?=$row["customer_id"]?>Help" class="form-text">Enter the Customer's name.</div>
                          <label for="EmployeeID" class="form-label">Employee ID</label>
                          <input type="text" class="form-control" id="sid" aria-describedby="nameHelp" name="eid" value="<?=$row['employee_id']?>">
                          <div id="nameHelp" class="form-text">Enter the Employee's ID</div>
                          <label for="ProductName" class="form-label">Product Name</label>
                          <input type="text" class="form-control" id="pName" aria-describedby="nameHelp" name="pName" value="<?=$row['product_name']?>">
                          <div id="nameHelp" class="form-text">Enter the Product Name</div>
                          <label for="ProductCost" class="form-label">Product Cost</label>
                          <input type="text" class="form-control" id="pCost" aria-describedby="nameHelp" name="pCost" value="<?=$row['product_cost']?>">
                          <div id="nameHelp" class="form-text">Enter the Product's cost</div>
                        </div>
                        <input type="hidden" name="cid" value="<?=$row['customer_id']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="cid" value="<?=$row["customer_id"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>
          </tr>
          
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
          
        </tbody>
      </table>
      <br />
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomer">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCustomerLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addCustomerLabel">Add Customer</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="customerName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="cName" aria-describedby="nameHelp" name="cName">
                  <div id="nameHelp" class="form-text">Enter the Customer's name.</div>
                   <label for="EmployeeID" class="form-label">Employee ID</label>
                   <input type="text" class="form-control" id="sid" aria-describedby="nameHelp" name="eid">
                   <div id="nameHelp" class="form-text">Enter the Employee's ID</div>
                          <label for="ProductName" class="form-label">Product Name</label>
                          <input type="text" class="form-control" id="pName" aria-describedby="nameHelp" name="pName">
                          <div id="nameHelp" class="form-text">Enter the Product Name</div>
                          <label for="ProductCost" class="form-label">Product Cost</label>
                          <input type="text" class="form-control" id="pCost" aria-describedby="nameHelp" name="pCost">
                          <div id="nameHelp" class="form-text">Enter the Product's cost</div>
                </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
