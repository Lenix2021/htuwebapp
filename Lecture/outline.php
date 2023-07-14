<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>E-Moderation</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
  <link rel="stylesheet" href="../css/outline.css?1234567890">
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
      <?php
      session_start();
      // connect to the database
      $conn = mysqli_connect("localhost","root","","emoderation");

      $encoded_id = $_GET['p'];

      // Decode the ID value
      $qid = base64_decode($encoded_id);

      //store selected id in session variable
      $_SESSION['varid'] = $qid;


      // check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // get the file path from the database
      $sql = "SELECT outlinepath FROM task WHERE id = '$qid'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $outlinepath = $row["outlinepath"];
      } else {
        echo "File not found";
      }

      // read the contents of the PDF file
      $contents = file_get_contents($outlinepath);

      // Retrieve the details from the database
      $query = "SELECT t.*, c.C_TITLE, l.LNAME
      FROM task t
      JOIN courses c ON t.C_CODE = c.C_CODE
      JOIN lecturer l ON c.LID = l.LID WHERE t.id = $qid";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $code = $row['C_CODE'];
      $title = $row['C_TITLE'];
      $lname = $row['LNAME'];
      $_SESSION['op'] = $row['outlinepath'];
  
 // Retrieve the details from the database
 $query = "SELECT LID,LTITLE FROM lecturer WHERE LNAME = '$lname'";
 $result = mysqli_query($conn, $query);
 $row = mysqli_fetch_assoc($result);
 $_SESSION['lecid'] = $row['LID'];
 $_SESSION['title'] = $row['LTITLE'];

      // close the database connection
      $conn->close();
      ?>

      <form action="form.php" method="POST">
        <div class="form-header">
          <h3>HO TECHNICAL UNIVERSITY</h3>
          <h4>FACULTY OF APPLIED SCIENCES AND TECHNOLOGY</h4>
          <h5>DEPARTMENT OF COMPUTER SCIENCE</h5>
          <h6>INTERNAL MODERATION OF HND EXAMINATION PAPERS</h6>
          <h6>Course Outline Form</h6>
        </div>
        <br>

        <div class="form-fields">
          <div class="ript">
            <input type="hidden" id="field1" name="field1" value="<?php echo "Computer Science" ?>" required readonly>
          </div>
          <div class="ript">
            <input type="hidden" id="field2" name="ccode" value="<?php echo $code ?>" required readonly>
          </div>
          <div class="ript">
            <input type="hidden" id="field2" name="ctitle" value="<?php echo $title ?>" required readonly>
          </div>
          <div class="ript">
            <input type="hidden" id="field2" name="examiner" value="<?php echo $lname; ?>" required readonly>
          </div>

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
                    <td>Course Outline</td>
                    <td>
                      <input type="radio" id="yes1" name="row1" value="Yes" required>
                      <label for="yes1">Yes</label>
                      <input type="radio" id="no1" name="row1" value="No" required>
                      <label for="no1">No</label>
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
                    <td>Does the paper cover the course outline?</td>
                    <td>
                      <input type="radio" id="yes3" name="row6" value="Yes" required>
                      <label for="yes3">Yes</label>
                      <input type="radio" id="no3" name="row6" value="No" required>
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
              <textarea id="general-observation" name="general_observation" rows="5" cols="30" required></textarea>
            </div>

            <div class="ript">
                      <input type="hidden" id="head-of-department"  value="<?php echo "Mr. Adolph Sedem Adu" ?>" name="head_of_department">
                      </div>
                      
          </fieldset>

          <div class="form-actions">
            <input type="submit" value="Approve" name="approveoutline">
          </div>
        </div>
      </form>
    </div>
  </div>
  <div id="pdf-viewer"></div>
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
