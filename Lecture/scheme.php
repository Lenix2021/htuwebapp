
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>E-Moderation</title>
  <link rel="shortcut icon" href="../img/ff.png" type="image/x-icon">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
  <style>
    .container {
      display: flex;
      flex-direction: row;
      height: 100vh;
    }

    #pdf-viewer-container {
      width: 60%;
      display: flex;
      align-items: flex-start;
      border: 1px solid #6d7fcc;
      padding: 10px;
      overflow: auto;
    }

    #pdf-viewer {
      width: 100%;
      height: 800px;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: auto;
    }

    .zoom-buttons {
      display: flex;
      flex-direction: row;
      gap: 10px;
      margin-left: 20px;
      width: 15%;
      margin-bottom: 10px;
    }
  
    
    .form-container {
      width: 40%;
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
   <?php
session_start();
// connect to the database
$conn = mysqli_connect("localhost","root","","emoderation");

$qid = $_SESSION['varid'];

// check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// get the file path from the database
$sql = "SELECT schemepath FROM task WHERE id = '$qid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $schemepath = $row["schemepath"];
} else {
  echo "File not found";
}

// read the contents of the PDF file
$contents = file_get_contents($schemepath);

// Retrieve the details from the database
$query = "SELECT * FROM task WHERE id = $qid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$code = $row['C_CODE'];
$_SESSION['sp'] = $row['schemepath'];

?>
   <form action="form.php" method="POST">
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;1,200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/outline.css?246810">

    <div class="form-header">
    <h3>HO TECHNICAL UNIVERSITY</h3>
          <h4>FACULTY OF APPLIED SCIENCES AND TECHNOLOGY</h4>
          <h5>DEPARTMENT OF COMPUTER SCIENCE</h5>
          <h6>INTERNAL MODERATION OF HND EXAMINATION PAPERS</h6>
          <h6>Marking Scheme Form</h6>
    </div>
    <br>

    <div class="form-fields">

        <fieldset>
            <legend>Section 1: Prerequisites</legend>
            <div class="form-table">
                <table>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Required Items</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Marking scheme</td>
                            <td>
                            <input type="radio" id="yes3" name="row3" value="Yes" required>
                        <label for="yes3">Yes</label>
                        <input type="radio" id="no3" name="row3" value="No" required>
                        <label for="no3">No</label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>

        <fieldset>
            <legend>Section 2: Verifications</legend>
            <div class="form-table">
                <table>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Required Items</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Is the time allowed for the paper adequate?</td>
                            <td>
                            <input type="radio" id="yes1" name="row4" value="Yes" required>
                        <label for="yes1">Yes</label>
                        <input type="radio" id="no1" name="row4" value="No" required>
                        <label for="no1">No</label>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Are the mark allocations for questions appropriate?</td>
                            <td>
                            <input type="radio" id="yes3" name="row8" value="Yes" required>
                        <label for="yes3">Yes</label>
                        <input type="radio" id="no3" name="row8" value="No" required>
                        <label for="no3">No</label>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Is the marking scheme relevant to the questions?</td>
                            <td>
                            <input type="radio" id="yes3" name="row12" value="Yes" required>
                        <label for="yes3">Yes</label>
                        <input type="radio" id="no3" name="row12" value="No" required>
                        <label for="no3">No</label>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Does the marking scheme provide sufficient information and answers to the questions?</td>
                            <td>
                            <input type="radio" id="yes3" name="row13" value="Yes" required>
                        <label for="yes3">Yes</label>
                        <input type="radio" id="no3" name="row13" value="No" required>
                        <label for="no3">No</label>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Are the answers in the marking scheme structured with breakdown of marks?</td>
                            <td>
                            <input type="radio" id="yes3" name="row14" value="Yes" required>
                        <label for="yes3">Yes</label>
                        <input type="radio" id="no3" name="row14" value="No" required>
                        <label for="no3">No</label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>

        <fieldset>
            <legend>Section 3: Recommendations/Observations</legend>
            <div class="ript">
            <textarea id="general-observation" name="general_observation2" rows="5" cols="30" required></textarea>
            </div>
        </fieldset>
        <fieldset>
        <div class="form-actions">
                        <input type="submit" value="Approve for printing" name="Approvescheme"> 
                        </div>  
                        <div class="form-actions">
                        <input type="submit" value="Approve With Minor Corrections" name="semiapprovescheme">
                        </div>
                        <div class="form-actions">
                        <input type="submit" value="Dissaprove" name="Dissaprovescheme">
                        </div>                     
        </fieldset>
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
