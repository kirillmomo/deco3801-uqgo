<?php

	session_start();
	include('fpdf.php');

	$pdf=new FPDF();
	// var_dump(get_class_methods($pdf));

	// Column widths
    $w = array(27, 27, 27, 27, 27, 27, 28);

	$pdf->AddPage();

    // Arial bold 15
    $pdf->SetFont('Arial','B',15);
    // Move to the right
    $pdf->Cell(80);
    // Title
    $pdf->Cell(30,10,'UQGO Report date: '.date("Y-m-d").'',0,0,'C');
    // Line break
    $pdf->Ln(20);

    $pdf->SetFont('Arial','',12);   
    $pdf->Cell($w[1],6,"Number",1,0,'C');
    $pdf->Cell($w[1],6,"Age",1,0,'C');
    $pdf->Cell($w[2],6,"Gender",1,0,'C');
    $pdf->Cell($w[3],6,"Height(cm)",1,0,'C');
    $pdf->Cell($w[4],6,"Weight(KG)",1,0,'C');
    $pdf->Cell($w[5],6,"Steps",1,0,'C');
    $pdf->Cell($w[6],6,"Distance(KM)",1,0,'C');
    $pdf->Cell($w[7],6,"Calories(kcal)",1,0,'C');
    $pdf->Ln();

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
    $pdf->Cell(array_sum($w),0,'','T');
    $pdf->Output();

    unset($_SESSION["user_age_arr_pdf"]);
    unset($_SESSION["user_gender_arr_pdf"]);
    unset($_SESSION["user_height_arr_pdf"]);
    unset($_SESSION["user_weight_arr_pdf"]);
    unset($_SESSION["session_steps_arr_pdf"]);
    unset($_SESSION["session_distance_arr_pdf"]);
    unset($_SESSION["session_cal_arr_pdf"]);

?>