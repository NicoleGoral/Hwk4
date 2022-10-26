<?php require_once("header.php"); ?>
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
      $sqlAdd = "insert into Student (studentName) value (?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("s", $_POST['sName']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Student added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Student set studentName=? where studentID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['sName'], $_POST['sID']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Student edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Student where studentID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['sID']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Student deleted.</div>';
      break;
  }
}
?>
    
      <h1>Students</h1>
      <table class="table table-striped">
        <thead>
          <tr>            
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Grade Level</th>
            <th>Course ID</th>   
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          
<?php
$sql = "SELECT studentID, studentName, gradeLevel, courseID FROM student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["studentID"]?></td>
            <td><?=$row["studentName"]?></td>
            <td><?=$row["gradeLevel"]?></td>
            <td><?=$row["courseID"]?></td>
            <td>
            
           </td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editStudent<?=$row["studentID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editStudent<?=$row["studentName"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editStudent<?=$row["studentName"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editStudent<?=$row["studentID"]?>Label">Edit Student</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editStudent<?=$row["studentID"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editStudent<?=$row["studentName"]?>Name" aria-describedby="editStudent<?=$row["studentID"]?>Help" name="sName" value="<?=$row['studentName']?>">
                          <div id="editStudent<?=$row["studentName"]?>Help" class="form-text">Enter the Student's name.</div>
                        </div>
                        <input type="hidden" name="sID" value="<?=$row['studentName']?>">
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
                <input type="hidden" name="sID" value="<?=$row["studentID"]?>" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudent">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addStudentLabel">Add Student</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="studentName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="supervisorName" aria-describedby="nameHelp" name="sName">
                  <div id="nameHelp" class="form-text">Enter the student's name.</div>
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
