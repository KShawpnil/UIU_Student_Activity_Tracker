<?php

include('db_connect.php');
session_start();

require_once('TCPDF-main/tcpdf.php');

if (isset($_GET['s_id']) && isset($_SESSION['username'])) {

    $username = $_SESSION['username'];

    //student table bio
    $sql = "SELECT student.s_id, student.name, student.email, student.phone,
    student.department,student.gender,student.dob FROM student WHERE student.s_id='$username'"; //INNER JOIN achievements ON student.s_id=achievements.s_id
    $query = mysqli_query($conn, $sql);

    //achv table all
    // $sql2 = "SELECT achievements.category, achievements.name, achievements.external_file, achievements.description,
    // achievements.keywords, achievements.v_id FROM student INNER JOIN achievements ON student.s_id=achievements.s_id WHERE student.s_id='$username'";
    // $query2 = mysqli_query($conn, $sql2);

    //achv cat
    $sqlprojects = "SELECT achievements.category, achievements.name, achievements.external_file, achievements.description,
    achievements.keywords, achievements.v_id FROM student INNER JOIN achievements ON student.s_id=achievements.s_id WHERE student.s_id='$username' AND achievements.category LIKE 'project'";
    $result1 = mysqli_query($conn, $sqlprojects);

    $sqlinternships = "SELECT achievements.category, achievements.name, achievements.external_file, achievements.description,
    achievements.keywords, achievements.v_id FROM student INNER JOIN achievements ON student.s_id=achievements.s_id WHERE student.s_id='$username' AND achievements.category LIKE 'internship'";
    $result2 = mysqli_query($conn, $sqlinternships);

    $sqlawards = "SELECT achievements.category, achievements.name, achievements.external_file, achievements.description,
    achievements.keywords, achievements.v_id FROM student INNER JOIN achievements ON student.s_id=achievements.s_id WHERE student.s_id='$username' AND achievements.category LIKE 'honors and awards'";
    $result3 = mysqli_query($conn, $sqlawards);

    $sqlextracurricularactivities = "SELECT achievements.category, achievements.name, achievements.external_file, achievements.description,
    achievements.keywords, achievements.v_id FROM student INNER JOIN achievements ON student.s_id=achievements.s_id WHERE student.s_id='$username' AND achievements.category LIKE 'extra-curricular activities'";
    $result4 = mysqli_query($conn, $sqlextracurricularactivities);


    //events table
    $sqlstudentevents = "SELECT events.name FROM participates INNER JOIN events ON participates.e_id=events.e_id WHERE participates.s_id='$username'";
    $result = mysqli_query($conn, $sqlstudentevents);

    //std info
    while ($row = mysqli_fetch_array($query)) {
        $name = $row['name'];
        $username = $row['s_id'];
        $email = $row['email'];
        $phone = $row['phone'];
        $department = $row['department'];
        $gender = $row['gender'];
        $dob = $row['dob'];
    }

    /**
     * 
     */
    class PDF extends TCPDF
    {
        public function Header()
        {
            //$this->Cell(189, 5, 'UIUSAT', 0, 0, 'L');
            // $imageFile = K_PATH_IMAGES . 'pic.jpg';
            // $this->Image($imageFile, 20, 10, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }
        public function Footer()
        {
             $this->SetY(280);
            // $this->Ln(2);
            // $this->SetFont('times', 'B', 10);
            // $this->Cell(20, 1, '__________________________', 0, 0);
            // $this->Cell(118, 1, '', 0, 0);
            // $this->Cell(51, 1, '___________________________', 0, 1);

            // $this->Cell(20, 5, 'Authorized Signature', 0, 0);
            // $this->Cell(118, 5, '', 0, 0);
            // $this->Cell(51, 5, 'Student Signature', 0, 1);

            $this->SetFont('helvetica', 'I', 8);
            //page num
            date_default_timezone_set("Asia/Dhaka");
            $today = date("F j, Y/ g:i A", time());

            $this->Cell(25, 5, 'Generation Date/Time: ' . $today, 0, 0, 'L');
            $this->Cell(164, 5, 'Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
        }
    }

    // create new PDF document
    $pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('UIUSAT');
    $pdf->SetTitle('CV');
    $pdf->SetSubject('');
    $pdf->SetKeywords('');

    //set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Set font
    $pdf->SetFont('dejavusans', '', 14, '', true);

    // $i = 1;
    // $max = 6;

    //Add a page
    $pdf->AddPage();

    //$pdf->Ln(3);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(189, 5, 'Name: ' . $name . ' ', 0, 1, 'C');
    $pdf->Cell(189, 5, 'ID: ' . $username . ' ', 0, 1, 'C');
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->Cell(189, 3, 'E-mail: ' . $email . ' ', 0, 1, 'C');
    $pdf->Cell(189, 3, 'Department: ' . $department . ' ', 0, 1, 'C');
    $pdf->Cell(189, 3, 'Gender: ' . $gender . ' ', 0, 1, 'C');
    $pdf->Cell(189, 3, 'Contact Number: ' . $phone . ' ', 0, 1, 'C');
    $pdf->Cell(189, 3, 'DOB: ' . $dob . ' ', 0, 1, 'C');
    $pdf->Cell(189, 5, '________________________________________________________________________', 0, 1, 'C');

    //$pdf->Line(12, 60, 200, 60); //after bio


    // while ($row = mysqli_fetch_array($query2)) {
    //     //$a_s_id = $row['s_id'];
    //     $a_category = $row['category'];
    //     $a_name = $row['name'];
    //     $a_external_file = $row['external_file'];
    //     $a_description = $row['description'];
    //     $a_keywords = $row['keywords'];
    //     //$file_links = $_FILES['file_link']['name'];
    //     $a_verified_by = $row['v_id'];

    //     $pdf->Ln(5);
    //     $pdf->SetFont('times', 'B', 10);
    //     $pdf->Cell(150, 5, 'Name: ' . $a_name . ' ', 0, 1);
    //     $pdf->Cell(150, 5, 'Category: ' . $a_category . ' ', 0, 1);
    //     $pdf->Cell(150, 5, 'Description: ' . $a_description . ' ', 0, 1);
    //     $pdf->Cell(150, 5, 'External file link: ' . $a_external_file . ' ', 0, 1);
    //     $pdf->Cell(150, 5, 'Keywords: ' . $a_keywords . ' ', 0, 1);
    //     $pdf->Cell(150, 5, 'Verifier: ' . $a_verified_by . ' ', 0, 1);
    //     $pdf->Cell(150, 5, '_______________________________________________________________________________________________________', 0, 1, 'L');
    // }

    $pdf->Ln(5);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(40, 5, 'Achievements', 1, 1,'L');
   // $pdf->Cell(150, 5, '____________', 0, 1, 'C');

    while ($row = mysqli_fetch_array($result1)) {

        $a_category = $row['category'];
        $a_name = $row['name'];
        $a_external_file = $row['external_file'];
        $a_description = $row['description'];
        $a_keywords = $row['keywords'];
        $a_verified_by = $row['v_id'];

        // if (!empty($row)) {
        //     $count = 0;
        //     foreach ($row as $username) {
        //       $count++;
        //     }
        // }

        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 10);
        //$pdf->Cell(150, 5, 'Project: ' . $count . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Category: ' . $a_category . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Name: ' . $a_name . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Description: ' . $a_description . ' ', 0, 1);
        $pdf->Cell(150, 5, 'External file link: ' . $a_external_file . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Keywords: ' . $a_keywords . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Verifier: ' . $a_verified_by . ' ', 0, 1);
        $pdf->Cell(150, 5, '____________________________________________________________', 0, 1, 'L');
    }
    $pdf->Cell(150, 5, '_______________________________________________________________________________________________________', 0, 1, 'L');

    while ($row = mysqli_fetch_array($result2)) {
        $a_category = $row['category'];
        $a_name = $row['name'];
        $a_external_file = $row['external_file'];
        $a_description = $row['description'];
        $a_keywords = $row['keywords'];
        $a_verified_by = $row['v_id'];

        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(150, 5, 'Category: ' . $a_category . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Name: ' . $a_name . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Description: ' . $a_description . ' ', 0, 1);
        $pdf->Cell(150, 5, 'External file link: ' . $a_external_file . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Keywords: ' . $a_keywords . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Verifier: ' . $a_verified_by . ' ', 0, 1);
        $pdf->Cell(150, 5, '____________________________________________________________', 0, 1, 'L');
    }
    $pdf->Cell(150, 5, '_______________________________________________________________________________________________________', 0, 1, 'L');

    while ($row = mysqli_fetch_array($result3)) {
        $a_category = $row['category'];
        $a_name = $row['name'];
        $a_external_file = $row['external_file'];
        $a_description = $row['description'];
        $a_keywords = $row['keywords'];
        $a_verified_by = $row['v_id'];

        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(150, 5, 'Category: ' . $a_category . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Name: ' . $a_name . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Description: ' . $a_description . ' ', 0, 1);
        $pdf->Cell(150, 5, 'External file link: ' . $a_external_file . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Keywords: ' . $a_keywords . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Verifier: ' . $a_verified_by . ' ', 0, 1);
        $pdf->Cell(150, 5, '____________________________________________________________', 0, 1, 'L');
    }
    $pdf->Cell(150, 5, '_______________________________________________________________________________________________________', 0, 1, 'L');

    while ($row = mysqli_fetch_array($result4)) {
        $a_category = $row['category'];
        $a_name = $row['name'];
        $a_external_file = $row['external_file'];
        $a_description = $row['description'];
        $a_keywords = $row['keywords'];
        $a_verified_by = $row['v_id'];

        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(150, 5, 'Category: ' . $a_category . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Name: ' . $a_name . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Description: ' . $a_description . ' ', 0, 1);
        $pdf->Cell(150, 5, 'External file link: ' . $a_external_file . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Keywords: ' . $a_keywords . ' ', 0, 1);
        $pdf->Cell(150, 5, 'Verifier: ' . $a_verified_by . ' ', 0, 1);
        $pdf->Cell(150, 5, '____________________________________________________________', 0, 1, 'L');
    }
    $pdf->Cell(150, 5, '_______________________________________________________________________________________________________', 0, 1, 'L');


    $pdf->Ln(5);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(40, 5, 'Events', 1, 1,'L');

    while ($row = mysqli_fetch_array($result)) {

        $userstudentevent = $row['name'];

        $pdf->Ln(5);
        $pdf->Cell(150, 5, 'Event Name: ' . $userstudentevent . ' ', 0, 1);
        $pdf->Cell(150, 5, '_______________________________________________________________________________________', 0, 1, 'L');
    }
}
// Close and output PDF document
$pdf->Output('CV.pdf', 'I');
