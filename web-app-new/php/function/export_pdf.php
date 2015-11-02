<?php
    // This is the generate report as PDF file function
    // is a plugin call fpdf
    // The website address http://www.fpdf.org/
    
	session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/v0-6/resources/fpdf/fpdf.php');

	$pdf=new FPDF();

	// Column widths
    $w = array(23.5, 23.5, 23.5, 23.5, 23.5, 23.5, 24, 24);

	$pdf->AddPage();

    // Arial bold 15
    $pdf->SetFont('Arial','B',15);
    // Move to the right
    $pdf->Cell(80);
    // Title
    $pdf->Cell(30,10,'UQGO Report date: '.date("Y-m-d").'',0,0,'C');
    // Line break
    $pdf->Ln(20);
    // Table title
    $pdf->SetFont('Arial','',10);   
    $pdf->Cell($w[1],6,"Number",1,0,'C');
    $pdf->Cell($w[1],6,"Age",1,0,'C');
    $pdf->Cell($w[2],6,"Gender",1,0,'C');
    $pdf->Cell($w[3],6,"Height(cm)",1,0,'C');
    $pdf->Cell($w[4],6,"Weight(KG)",1,0,'C');
    $pdf->Cell($w[5],6,"Steps",1,0,'C');
    $pdf->Cell($w[6],6,"Distance(KM)",1,0,'C');
    $pdf->Cell($w[7],6,"Calories(kcal)",1,0,'C');
    $pdf->Ln();
    // data
    for($a=0;$a<sizeof($_SESSION['user_age_arr_pdf']);$a++)
    {
        $pdf->Cell($w[1],6,$a+1,1,0,'C');
        $pdf->Cell($w[1],6,$_SESSION['user_age_arr_pdf'][$a],1,0,'C');
        $pdf->Cell($w[2],6,$_SESSION['user_gender_arr_pdf'][$a],1,0,'C');
        $pdf->Cell($w[3],6,$_SESSION['user_height_arr_pdf'][$a],1,0,'C');
        $pdf->Cell($w[4],6,$_SESSION['user_weight_arr_pdf'][$a],1,0,'C');
        $pdf->Cell($w[5],6,$_SESSION['session_steps_arr_pdf'][$a],1,0,'C');
        $pdf->Cell($w[6],6,$_SESSION['session_distance_arr_pdf'][$a],1,0,'C');
        $pdf->Cell($w[7],6,$_SESSION['session_cal_arr_pdf'][$a],1,0,'C');
        $pdf->Ln();
    }
    // register into the PDF file
    $pdf->Cell(array_sum($w),0,'','T');
    $pdf->Output();

    // delete all the user session data that generate in the admin page
    unset($_SESSION["user_age_arr_pdf"]);
    unset($_SESSION["user_gender_arr_pdf"]);
    unset($_SESSION["user_height_arr_pdf"]);
    unset($_SESSION["user_weight_arr_pdf"]);
    unset($_SESSION["session_steps_arr_pdf"]);
    unset($_SESSION["session_distance_arr_pdf"]);
    unset($_SESSION["session_cal_arr_pdf"]);

?>