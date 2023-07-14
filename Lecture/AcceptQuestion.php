<?php
session_start();
// connect to the database
$conn = mysqli_connect("localhost","root","","emoderation");


 $encoded_id = $_GET['p'];

  // Decode the ID value
$qid = base64_decode($encoded_id);


// check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// get the file path from the database
$sql = "SELECT questionpath FROM approve WHERE id = '$qid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $questionpath = $row["questionpath"];
} else {
  echo "File not found";
}

// read the contents of the PDF file
$contents = file_get_contents($questionpath);

// Retrieve the details from the database
$query = "SELECT * FROM approve WHERE id = $qid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$code = $row['C_CODE'];

if (isset($_POST['Accept'])) {
	// update database
	$sql_update = "UPDATE print SET questionpath = '$questionpath' WHERE C_CODE = '$code'";

	if(mysqli_query($conn, $sql_update))
{   $query = "DELETE FROM disaprove where C_CODE = '$code'";
    $result = mysqli_query($conn, $query);

    $query = "DELETE FROM approve where C_CODE = '$code'";
    $result = mysqli_query($conn, $query);

  // Redirect the user back to the moderation page
     header("Location:Accept.php");
     exit();
}

}

if (isset($_POST['reject'])) {
    $comment = $_POST['reject_comment'];
	
    $sql_update = "UPDATE disaprove SET comment = '$comment' , progress = 'pending' WHERE C_CODE = '$code'";
    
	if(mysqli_query($conn, $sql_update))
{
    
    $query = "DELETE FROM approve where C_CODE = '$code'";
    $result = mysqli_query($conn, $query);

    if (file_exists($questionpath)) {
        if (unlink($questionpath)) {
            echo "File deleted successfully.";
        } else {
            echo "Unable to delete the file.";
        }
       } else {
        echo "File not found.";
       }

        // Redirect the user back to the moderation page
 header("Location:Accept.php");
 exit();
    
}


} 


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>E-Moderation</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
  <link rel="stylesheet" href="../css/outline.css?">
  <link rel="shortcut icon" href="../img/ff.png" type="image/x-icon">
  <style>
    .container {
      display: flex;
      flex-direction: row;
      height: 100vh;
    }

    #pdf-viewer-container {
      width: 70%;
      display: flex;
      align-items: flex-start;
      border: 1px solid #6d7fcc;
      padding: 10px;
      overflow: auto;
    }

    /* #pdf-viewer {
      width: 100%;
      height: 800px;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: auto;
    } */
    .zoom-buttons {
      display: flex;
      flex-direction: row;
      gap: 10px;
      margin-left: 20px;
      width: 15%;
      margin-bottom: 10px;
    }
    .form-container {
      width: 30%;
      padding: 20px;
      overflow: auto;
    }
  </style>
</head>
<body>
<div class="zoom-buttons">
        <button id="zoom-in">+</button>
        <button id="zoom-out">-</button>
        <button id="prev-page"><</button>
        <button id="next-page">></button>
        <div id="page-counter"></div>
      </div>
  <div class="container">
    <div id="pdf-viewer-container">
      <div id="pdf-viewer"></div>
      </div>
 
    <div class="form-container">

      <form method="POST">
        <div class="form-header">
          <h3>HO TECHNICAL UNIVERSITY</h3>
          <h4>FACULTY OF APPLIED SCIENCES AND TECHNOLOGY</h4>
          <h5>DEPARTMENT OF COMPUTER SCIENCE</h5>
          <h6>INTERNAL MODERATION OF HND EXAMINATION PAPERS</h6>
          <h6>Approval of re-uploaded material</h6>
        </div>
        <br>
          <div class="form-actions">
          <input type="submit" value="Approve" name="Accept">
          </div>
  </br>

          <div class="ript" style="margin-left: 130px;">
            <textarea id="general-observation" name="reject_comment" placeholder="Reason for Rejection"></textarea>
            </div>


          <div class="form-actions">
          <input type="submit" value="Dissaprove" name="reject">
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
  const pdfViewer = document.getElementById('pdf-viewer');
  const pageCounter = document.getElementById('page-counter');
  let scale = 1.0;
  let pageNumber = 1;
  let pdfInstance = null;

  function renderPage(pageNum) {
    pdfInstance.getPage(pageNum).then(page => {
      const viewport = page.getViewport({ scale });
      const canvas = document.createElement('canvas');
      const canvasContext = canvas.getContext('2d');
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      const renderContext = {
        canvasContext,
        viewport
      };

      page.render(renderContext).promise.then(() => {
        pdfViewer.innerHTML = '';
        pdfViewer.appendChild(canvas);

        // Update the page counter
        pageCounter.textContent = `${pageNum} of ${pdfInstance.numPages}`;
      });
    });
  }

  function zoomIn() {
    scale += 0.1;
    renderPage(pageNumber);
  }

  function zoomOut() {
    scale -= 0.1;
    renderPage(pageNumber);
  }

  function previousPage() {
    if (pageNumber <= 1) return;
    pageNumber--;
    renderPage(pageNumber);
  }

  function nextPage() {
    if (pageNumber >= pdfInstance.numPages) return;
    pageNumber++;
    renderPage(pageNumber);
  }

  document.getElementById('zoom-in').addEventListener('click', zoomIn);
  document.getElementById('zoom-out').addEventListener('click', zoomOut);
  document.getElementById('prev-page').addEventListener('click', previousPage);
  document.getElementById('next-page').addEventListener('click', nextPage);

  // Assuming pdfjsLib is included separately
  pdfjsLib.getDocument({ data: atob("<?php echo base64_encode($contents); ?>") })
    .promise.then(pdf => {
      pdfInstance = pdf;
      renderPage(pageNumber);
    });
</script>
</body>
</html>
