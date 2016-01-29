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
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array(
			'argb' => 'FF92D050',
		),
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
			'argb' => 'FFDDEBF7',
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
$seq = 3;
$offset = 1;
$depts = DB::table('departments')->get();
$offest_array = array("Total");
$date_sql = "where date_sub between '".date("Y-m-d", strtotime($_POST["date_from"]))."' and '".date("Y-m-d", strtotime($_POST["date_to"]))."' ";
$table1t5 = array("Table 1 - Methodology by Department","Table 2 - Methodology by Status","Table 3 - Methodology by Executive", "Table 4 - Methodology by Currency","Table 5 - Methodology by Probability"); 

for ($i=0; $i < 5 ; $i++) { 
//START - Table 1 - Methodology by Department
$seq_top_in = $seq;
$cell_val = 0;
$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset).$seq, $table1t5[$i]);
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset).$seq)->applyFromArray($styleArray1);
$seq = $seq+2;
$seq_in = $seq;
$cell_start = $cell_val;
$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset).$seq.':'.getNameFromNumber($offset).($seq+1));
$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'Proposal Status for the month')->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);
$objPHPExcel->getActiveSheet()->getColumnDimension(getNameFromNumber($offset+$cell_val))->setWidth(20);

$cell_val++;
foreach ($offest_array as $off) {
	$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset+$cell_val).$seq.':'.getNameFromNumber($offset+$cell_val+1).$seq);
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $off);
	$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray3);
	$seq++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'No.')->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);;
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'Value')->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);;
	$seq--;
	$cell_val++;
}

foreach ($depts as $dep) {
	$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset+$cell_val).$seq.':'.getNameFromNumber($offset+$cell_val+1).$seq);
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $dep->department);
	$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray3);
	$seq++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'No.')->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);;
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'Value')->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);;
	$seq--;
	$cell_val++;
}
$seq = $seq+2;
$sql_data_start = $seq;
$ar_values = array();
switch ($i) {
	case 0:
		$meths = DB::table('methodologies')->select('id','methodology as name')->get();
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, methodology_id as base_id, department_id from proposals ".$date_sql." group by methodology_id, department_id ");
		break;
	case 1:
		$meths = DB::table('status')->select('id','status as name')->get();
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, status_id as base_id, department_id from proposals ".$date_sql." group by status_id, department_id ");
		break;
	case 2:
		$meths = DB::table('users')->select('id','name')->get();
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, user_id as base_id, department_id from proposals ".$date_sql." group by user_id, department_id ");
		break;
	case 3:
		$meths = DB::table('currencies')->select('id','currency as name')->get();
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value) as sum, currency_id as base_id, department_id from proposals ".$date_sql." group by currency_id, department_id ");
		break;
	case 4:
		$meths = DB::table('probabilities')->select('id','probability as name')->get();
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, probability_id as base_id, department_id from proposals ".$date_sql." group by probability_id, department_id ");
		break;
}

foreach ($values as $value) {
	$ar_values[$value->base_id][$value->department_id] = array($value->count, $value->sum);
}
foreach ($meths as $meth) {
	$cell_val = 0;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $meth->name);
	$cell_val++;
	foreach ($offest_array as $off) {
		$count = 0; $sum = 0;
		
		if(isset($ar_values[$meth->id])){
			foreach ($ar_values[$meth->id] as $total_item) {
					$count += $total_item[0];
					$sum += $total_item[1];
			}
		}
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $count);
		$cell_val++;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $sum);
		$cell_val++;
	}
	foreach ($depts as $dep) {
		if(isset($ar_values[$meth->id][$dep->id][0]))
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $ar_values[$meth->id][$dep->id][0]);
		$cell_val++;
		if(isset($ar_values[$meth->id][$dep->id][1]))
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $ar_values[$meth->id][$dep->id][1]);
		$cell_val++;
	}
	$seq++;
}
	if($i != 3){
	//GRAND TOTAL
	$cell_val = 0;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'Grand Total');
	$cell_val++;
	foreach ($offest_array as $off) {
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
	}
	foreach ($depts as $dep) {
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
	}
	$cell_val--;
	$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset).$seq.':'.getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);
	//END GRAND TOTAL
	} else {
		$seq--;
		$cell_val--;
	}

$cell_end = $cell_val;
$seq_out = $seq;
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset+$cell_start).$seq_in.':'.getNameFromNumber($offset+$cell_end).$seq_out)->applyFromArray($styleArrayborder);
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset).$seq_in.':'.getNameFromNumber($offset).$seq_out)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset).$seq_top_in.':'.getNameFromNumber($offset+$cell_end).$seq_top_in);
//END - Table 1 - Methodology by Department
$seq = $seq +3;
}



$table1t5 = array("Table 6 - Department by Month","Table 7 - Status by Month","Table 8 - Methodology by Month", "Table 9 - Executive by Month","Table 10 - Probability by Month"); 


$offset = $cell_end + 5;
$seq = 3;
for ($i=0; $i < 5 ; $i++) { 
//START - Table 1 - Methodology by Department
$seq_top_in = $seq;
$cell_val = 0;
$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset).$seq, $table1t5[$i]);
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset).$seq)->applyFromArray($styleArray1);
$seq = $seq+2;
$seq_in = $seq;
$cell_start = $cell_val;
$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset).$seq.':'.getNameFromNumber($offset).($seq+1));
$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, '')->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);
$objPHPExcel->getActiveSheet()->getColumnDimension(getNameFromNumber($offset+$cell_val))->setWidth(20);

$cell_val++;
switch ($i) {
	case 0:
		$bases = DB::table('departments')->select('id','department as name')->get();
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, department_id as base_id, month, year from proposals ".$date_sql." group by year, month, department_id");
		break;
	case 1:
		$bases = DB::table('status')->select('id','status as name')->get();
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, status_id as base_id, month, year from proposals ".$date_sql." group by year, month, status_id");
		break;
	case 2:
		$bases = DB::table('methodologies')->select('id','methodology as name')->get();
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, methodology_id as base_id, month, year from proposals ".$date_sql." group by year, month, methodology_id");
		break;
	case 3:
		$bases = DB::table('users')->select('id','name')->get();
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, user_id as base_id, month, year from proposals ".$date_sql." group by year, month, user_id");
		break;
	case 4:
		$bases = DB::table('probabilities')->select('id','probability as name')->get();
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, probability_id as base_id, month, year from proposals ".$date_sql." group by year, month, probability_id");
		break;
}
foreach ($offest_array as $off) {
	$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset+$cell_val).$seq.':'.getNameFromNumber($offset+$cell_val+1).$seq);
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $off);
	$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray3);
	$seq++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'No.')->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);;
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'Value')->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);;
	$seq--;
	$cell_val++;
}
foreach ($bases as $base) {
	$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset+$cell_val).$seq.':'.getNameFromNumber($offset+$cell_val+1).$seq);
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $base->name);
	$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray3);
	$seq++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'No.')->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);;
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'Value')->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);;
	$seq--;
	$cell_val++;
}
$seq = $seq+2;
$sql_data_start = $seq;
$ar_values = array();

$ar_year_months = array();
$ar_year_check = array();
foreach ($values as $value) {
	$ar_values[$value->year][$value->month][$value->base_id] = array($value->count, $value->sum);

	if(!in_array($value->month.'-'.$value->year, $ar_year_check)){
		array_push($ar_year_check, $value->month.'-'.$value->year);
		array_push($ar_year_months, array(date("M",strtotime("01-".$value->month."-2015")).'-'.date("y",strtotime("01-01-".$value->year)), $value->month, $value->year ));
	}
}
foreach ($ar_year_months as $month) {
	$cell_val = 0;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $month[0]);
	$cell_val++;
	foreach ($offest_array as $off) {
		$count = 0; $sum = 0;
		
		if(isset($ar_values[$month[2]][$month[1]])){
			foreach ($ar_values[$month[2]][$month[1]] as $total_item) {
					$count += $total_item[0];
					$sum += $total_item[1];
			}
		}
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $count);
		$cell_val++;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $sum);
		$cell_val++;
	}
	foreach ($bases as $base) {
		if(isset($ar_values[$month[2]][$month[1]][$base->id][0]))
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $ar_values[$month[2]][$month[1]][$base->id][0]);
		$cell_val++;
		if(isset($ar_values[$month[2]][$month[1]][$base->id][1]))
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $ar_values[$month[2]][$month[1]][$base->id][1]);
		$cell_val++;
	}
	$seq++;
}
	//GRAND TOTAL
		$cell_val = 0;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'Grand Total');
		$cell_val++;
		foreach ($offest_array as $off) {
			$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
			$cell_val++;
			$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
			$cell_val++;
		}
		foreach ($bases as $base) {
			$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
			$cell_val++;
			$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
			$cell_val++;
		}
		$cell_val--;
		$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset).$seq.':'.getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);
	//END GRAND TOTAL

$cell_end = $cell_val;
$seq_out = $seq;
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset+$cell_start).$seq_in.':'.getNameFromNumber($offset+$cell_end).$seq_out)->applyFromArray($styleArrayborder);
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset).$seq_in.':'.getNameFromNumber($offset).$seq_out)->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset).$seq_top_in.':'.getNameFromNumber($offset+$cell_end).$seq_top_in);
//END - Table 1 - Methodology by Department
$seq = $seq +3;
}




$objPHPExcel->getProperties()->setCreator("MRC")->setLastModifiedBy("MRC");
$objPHPExcel->getActiveSheet()->setTitle('Proposals');
$name = 'Report_'.date("dMy",strtotime("today"));

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$name.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;