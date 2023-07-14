<?php

// connect to the database
$conn = mysqli_connect("localhost", "root", "", "emoderation");

$encoded_id = $_GET['p'];

// Decode the ID value
$qid = base64_decode($encoded_id);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get the file path from the database
$sql =  "SELECT p.*, c.C_TITLE FROM print p JOIN courses c ON p.C_CODE = c.C_CODE WHERE p.id = '$qid'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $opath = $row["outlinepath"];
    $course_title = $row["C_TITLE"];
    $ccode = $row['C_CODE'];

    // read the contents of the PDF file
    $contents = file_get_contents($opath);
    

    // set the HTTP headers to display the PDF in the browser
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' .$ccode." ". $course_title ." Course Outline". '.pdf"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');

    // display the contents of the PDF file
    echo $contents;
} else {
    echo "File not found";
}

// close the database connection
$conn->close();
?>