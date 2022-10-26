<?php require_once("header.php"); ?>
<h1>Courses</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Course ID</th>
      <th>Prefix</th>
      <th>Number</th>
      <th>Description</th>
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
      $sqlAdd = "insert into course (courseID, coursePrefix, courseNumber, courseDescription) value (?,?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sisi", $_POST['cID'], $_POST['cPre'], $_POST['cNum'], $_POST['cDes']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Course added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update course set courseID=?, coursePrefix=?, courseNumber=?, courseDescription=? where courseID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sisii", $_POST['cID'], $_POST['cPre'], $_POST['cNum'], $_POST['cDes'], $_POST['cID']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Course edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from course where courseID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['cID']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Course deleted.</div>';
      break;
  }
}
?>         
<?php
$sql = "SELECT courseID, coursePrefix, courseNumber, courseDescription FROM course";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
          
          <tr>
            <td><?=$row["courseID"]?></td>
            <td><?=$row["coursePrefix"]?></td>
            <td><?=$row["courseNumber"]?></td>
            <td><?=$row["courseDescription"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editcourse<?=$row["courseID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editCourse<?=$row["courseID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCourse<?=$row["courseID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editCourse<?=$row["courseID"]?>Label">Edit Course</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editCourse<?=$row["courseID"]?>Name" class="form-label">Course Prefix</label>
                          <input type="text" class="form-control" id="editCourse<?=$row["courseID"]?>Name" aria-describedby="editCourse<?=$row["courseID"]?>Help" name="cPre" value="<?=$row['coursePrefix']?>">
                          <div id="editCourse<?=$row["courseID"]?>Help" class="form-text">Enter the Course's Prefix.</div>
                          <label for="courseNumber" class="form-label">Course Number</label>
                          <input type="text" class="form-control" id="cNum" aria-describedby="nameHelp" name="cNum" value="<?=$row['courseNumber']?>">
                          <div id="nameHelp" class="form-text">Enter the Course's Number</div>
                          <label for="courseDescription" class="form-label">Course Description</label>
                          <input type="text" class="form-control" id="cDes" aria-describedby="nameHelp" name="cDes" value="<?=$row['courseDescription']?>">
                          <div id="nameHelp" class="form-text">Enter the Course Description</div>
                        </div>
                        <input type="hidden" name="cID" value="<?=$row['courseID']?>">
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
                <input type="hidden" name="cID" value="<?=$row["courseID"]?>" />
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourse">
        Add New
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addCourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCourseLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addCourseLabel">Add Course</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
                  <label for="coursePrefix" class="form-label">Course Prefix</label>
                  <input type="text" class="form-control" id="cPre" aria-describedby="nameHelp" name="cPre">
                  <div id="nameHelp" class="form-text">Enter the Course's Prefix.</div>
                          <label for="courseNumber" class="form-label">Course Number</label>
                          <input type="text" class="form-control" id="cNum" aria-describedby="nameHelp" name="cNum">
                          <div id="nameHelp" class="form-text">Enter the Course's Number</div>
                          <label for="courseDescription" class="form-label">Course Description</label>
                          <input type="text" class="form-control" id="cDes" aria-describedby="nameHelp" name="cDes">
                          <div id="nameHelp" class="form-text">Enter the course's description</div>
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
