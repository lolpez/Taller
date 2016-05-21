<?php
error_reporting(0);
require_once ('dompdf_config.inc.php');
	$name = date("Ymd").rand().'.pdf';
	$pdf_content = file_get_contents('lol.php') ;	
	$reportPDF=createPDF(12, $pdf_content, 'activity_Report', $name );
	function createPDF($pdf_userid, $pdf_content, $pdf_For, $filename){	
		$path='UsersActivityReports/';
		/*$rndNumber=rand();
		$filename=$pdf_userid.date("Ymd").$rndNumber.'.pdf';*/
		$dompdf=new DOMPDF();
		$dompdf->load_html($pdf_content);		
		$dompdf->render();
		$output = $dompdf->output();
		file_put_contents($path.$filename, $output);
		return $filename;		
	}	
	echo '<a href="UsersActivityReports/'.$name.'" > Download </a>';
?>