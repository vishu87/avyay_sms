<?php

$objPHPExcel = new PHPExcel();
$styleArray1 = array(
	'font' => array(
		'bold' => true,
		'color' => array('argb' => 'FF000000',)
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'WrapText' => true,
	),
);
$styleArray2 = array(
	'font' => array(
		'bold' => true,
		'color' => array('argb' => 'FF000000',)
	),
	'alignment' => array(
		'WrapText' => true,
	),
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array(
			'argb' => 'FF92D050',
		),
	)
);
$styleArray3 = array(
	'font' => array(
		'bold' => true,
		'color' => array('argb' => 'FF000000',)
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'WrapText' => true,
	)
);
$styleArrayborder = array('borders' => array(
	'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN,
		'color' => array('argb' => 'FF000000'),
	),
),);
function getNameFromNumber($num) {
    $numeric = ($num ) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num ) / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2 - 1) . $letter;
    } else {
        return $letter;
    }
}
$type = '';
if(Input::get("status")){
	foreach (Input::get("status") as $status_type) {
		$type .= $status[$status_type].' /';
	}
}

if(Input::get("status"))
	$status_ids = implode(',', Input::get("status"));
else $status_ids = 0;
$date_sql = "where date_sub between '".date("Y-m-d", strtotime(Input::get("date_from")))."' and '".date("Y-m-d", strtotime(Input::get("date_to")))."' and status_id IN (".$status_ids.") ";

$objPHPExcel->getActiveSheet()->mergeCells('A1:R1');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Proposal Status: '.$type.'   Date '.date("d-M-Y", strtotime($_POST["date_from"])).' - '.date("d-M-Y", strtotime($_POST["date_to"])));
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray1);

$seq = 3;
$offset = 0;
$cell_val = 0;

$seq_in = $seq;


$ar_names = array("SN","Proposal ID","Date","Office","User","Department","Client","Description","Methodology","Sample Qual", "Sample Quan", "Locations", "Proposal Value","Currency","Proposal Value in Naira","Probability","Status","Remarks");

$proposals = DB::select("SELECT * from proposals ".$date_sql." order by date_sub asc");
$width = array("4","10","12","12","20","20","20","20","20","20","12","12","15","10","15","20","20","20");
$count = 0;
foreach ($ar_names as $name) {
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $name);
	$objPHPExcel->getActiveSheet()->getColumnDimension(getNameFromNumber($offset+$cell_val))->setWidth($width[$count]);
	$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);
	$cell_val++;
	$count++;
}
$seq++;

$count = 1;
foreach ($proposals as $proposal) {
	$cell_val = 0;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $count);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $proposal->proposal_id);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, date("d-M-Y", strtotime($proposal->date_sub)));
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $offices[$proposal->office_id]);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $users[$proposal->user_id]);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $departments[$proposal->department_id]);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $proposal->client_name);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $proposal->description);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $methodologies[$proposal->methodology_id]);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $proposal->sample_qual);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $proposal->sample_quan);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $proposal->locations);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $proposal->proposal_value);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $currencies[$proposal->currency_id]);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $proposal->proposal_value_naira);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $probabilities[$proposal->probability_id]);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $status[$proposal->status_id]);
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $proposal->remarks);
	$cell_val++;
	$seq++;
	$count++;
}

$cell_val--;
$seq--;
$seq_out = $seq;
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset).$seq_in.':'.getNameFromNumber($offset+$cell_val).$seq_out)->applyFromArray($styleArrayborder);
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset).$seq_in.':'.getNameFromNumber($offset+$cell_val).$seq_out)->getAlignment()->setWrapText(true);

$objPHPExcel->getProperties()->setCreator("MRC")->setLastModifiedBy("MRC");
$objPHPExcel->getActiveSheet()->setTitle('Proposals');
$name = 'Proposals_'.date("d-m-y", strtotime($_POST["date_from"])).'_to_'.date("d-m-y", strtotime($_POST["date_to"]));

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$name.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;