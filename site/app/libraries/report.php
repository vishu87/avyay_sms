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
$seq = 3;
$offset = 0;
$offest_array = array("Total");
if(Input::get("office") == 0)
	$date_sql = "where date_sub between '".date("Y-m-d", strtotime(Input::get("date_from")))."' and '".date("Y-m-d", strtotime(Input::get("date_to")))."' ";
else
	$date_sql = "where date_sub between '".date("Y-m-d", strtotime(Input::get("date_from")))."' and '".date("Y-m-d", strtotime(Input::get("date_to")))."' and office_id = ".Input::get("office")." ";
$table1t5 = array("Department x Methodology","Status x Methodology","Probability x Methodology","Department x Status","Methodology x Status","Probability x Status","Methodology x Executive","Department x Probability"); 
for ($i=0; $i < 8 ; $i++) { 
//START - Table 1 - Methodology by Department
$seq_top_in = $seq;
$cell_val = 0;
$seq_in = $seq;
$cell_start = $cell_val;


switch ($i) {
	case 0:
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, methodology_id as yid, department_id as xid from proposals ".$date_sql." group by methodology_id, department_id ");
		$xvals = DB::table('departments')->select('id','department as name')->get();
		$yvals = DB::table('methodologies')->select('id','methodology as name')->get();
		break;
	case 1:
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, methodology_id as yid, status_id as xid from proposals ".$date_sql." group by methodology_id, status_id ");
		$xvals = DB::table('status')->select('id','status as name')->get();
		$yvals = DB::table('methodologies')->select('id','methodology as name')->get();

		break;
	case 2:
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, methodology_id as yid, probability_id as xid from proposals ".$date_sql." group by methodology_id, probability_id ");
		$xvals = DB::table('probabilities')->select('id','probability as name')->get();
		$yvals = DB::table('methodologies')->select('id','methodology as name')->get();
		break;
	case 3:
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, status_id as yid, department_id as xid from proposals ".$date_sql." group by status_id, department_id ");
		$yvals = DB::table('status')->select('id','status as name')->get();
		$xvals = DB::table('departments')->select('id','department as name')->get();
		break;
	case 4:
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, status_id as yid, methodology_id as xid from proposals ".$date_sql." group by status_id, methodology_id ");
		$yvals = DB::table('status')->select('id','status as name')->get();
		$xvals = DB::table('methodologies')->select('id','methodology as name')->get();
		break;
	case 5:
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, status_id as yid, probability_id as xid from proposals ".$date_sql." group by status_id, probability_id ");
		$yvals = DB::table('status')->select('id','status as name')->get();
		$xvals = DB::table('probabilities')->select('id','probability as name')->get();
		break;
	case 6:
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, user_id as yid, methodology_id as xid from proposals ".$date_sql." group by user_id, methodology_id ");
		$yvals = DB::table('users')->select('id','name as name')->get();
		$xvals = DB::table('methodologies')->select('id','methodology as name')->get();
		break;
	case 7:
		$values = DB::select("SELECT COUNT(id) as count, SUM(proposal_value_naira) as sum, probability_id as yid, department_id as xid from proposals ".$date_sql." group by probability_id, department_id ");
		$yvals = DB::table('probabilities')->select('id','probability as name')->get();
		$xvals = DB::table('departments')->select('id','department as name')->get();
		break;

}

$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset).$seq, 'Table '.($i+1));
$seq++;
$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset).$seq.':'.getNameFromNumber($offset).($seq+1));
$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $table1t5[$i])->getStyle(getNameFromNumber($offset+$cell_val).$seq)->applyFromArray($styleArray2);
$objPHPExcel->getActiveSheet()->getColumnDimension(getNameFromNumber($offset+$cell_val))->setWidth(20);
$cell_val++;
$seq--;
foreach ($offest_array as $off) {
	$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset+$cell_val).$seq.':'.getNameFromNumber($offset+$cell_val+3).$seq);
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $off);
	$seq++;
	
	$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset+$cell_val).$seq.':'.getNameFromNumber($offset+$cell_val+1).$seq);
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'No. of Proposals');

	$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset+$cell_val+2).$seq.':'.getNameFromNumber($offset+$cell_val+3).$seq);
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val+2).$seq, 'Value of Proposals');
	$seq++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'No.');
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, '%');
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'NGN');
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, '%');
	$seq = $seq - 2;
	$cell_val++;
}

foreach ($xvals as $xval) {
	$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset+$cell_val).$seq.':'.getNameFromNumber($offset+$cell_val+3).$seq);
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $xval->name);
	$seq++;
	
	$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset+$cell_val).$seq.':'.getNameFromNumber($offset+$cell_val+1).$seq);
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'No. of Proposals');

	$objPHPExcel->getActiveSheet()->mergeCells(getNameFromNumber($offset+$cell_val+2).$seq.':'.getNameFromNumber($offset+$cell_val+3).$seq);
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val+2).$seq, 'Value of Proposals');
	$seq++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'No.');
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, '%');
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'NGN');
	$cell_val++;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, '%');
	$seq = $seq - 2;
	$cell_val++;
}
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset+1).$seq.':'.getNameFromNumber($offset+$cell_val).($seq+2))->applyFromArray($styleArray1);
$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Office: '.$offices[Input::get("office")].' /  Date: '.date("d-M-Y", strtotime($_POST["date_from"])).' - '.date("d-M-Y", strtotime($_POST["date_to"])));
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray1);

$seq = $seq+3;
$sql_data_start = $seq;
$ar_values = array();

$total_count = 0;
$total_sum = 0;
foreach ($values as $value) {
	$ar_values[$value->yid][$value->xid] = array($value->count, $value->sum);
	$total_count += $value->count;
	$total_sum += $value->sum;
}
foreach ($yvals as $yval) {
	$cell_val = 0;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $yval->name);
	$cell_val++;
	foreach ($offest_array as $off) {
		$count = 0; $sum = 0;
		
		if(isset($ar_values[$yval->id])){
			foreach ($ar_values[$yval->id] as $total_item) {
					$count += $total_item[0];
					$sum += $total_item[1];
			}
		}
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $count);
		$cell_val++;
		if($total_count)
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, round($count*100/$total_count,2));
		$cell_val++;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $sum);
		$cell_val++;
		if($total_sum)
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, round($sum*100/$total_sum,2));
		$cell_val++;
	}
	foreach ($xvals as $xval) {
		if(isset($ar_values[$yval->id][$xval->id][0]))
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $ar_values[$yval->id][$xval->id][0]);
		$cell_val++;
		if(isset($ar_values[$yval->id][$xval->id][0]) && $total_count)
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, round($ar_values[$yval->id][$xval->id][0]*100/$total_count,2));
		$cell_val++;

		if(isset($ar_values[$yval->id][$xval->id][1]))
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, $ar_values[$yval->id][$xval->id][1]);
		$cell_val++;
		if(isset($ar_values[$yval->id][$xval->id][1]) && $total_sum)
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, round($ar_values[$yval->id][$xval->id][1]*100/$total_sum,2));
		$cell_val++;
	}
	$seq++;
}
	if($i != 50){ //dummy
	//GRAND TOTAL
	$cell_val = 0;
	$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, 'Grand Total');
	$cell_val++;
	foreach ($offest_array as $off) {
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
	}
	foreach ($xvals as $xval) {
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
		$objPHPExcel->getActiveSheet()->setCellValue(getNameFromNumber($offset+$cell_val).$seq, "=SUM(".getNameFromNumber($offset+$cell_val).$sql_data_start.":".getNameFromNumber($offset+$cell_val).($seq-1).")");
		$cell_val++;
	}
	$cell_val--;
	$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset).$seq.':'.getNameFromNumber($offset).$seq)->applyFromArray($styleArray2);
	//END GRAND TOTAL
	} else {
		$seq--;
		$cell_val--;
	}

$cell_end = $cell_val;
$seq_out = $seq;
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset+$cell_start).$seq_in.':'.getNameFromNumber($offset+$cell_end).$seq_out)->applyFromArray($styleArrayborder);
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset).$seq_in.':'.getNameFromNumber($offset).$seq_out)->getAlignment()->setWrapText(true);
//END - Table 1 - Methodology by Department
$seq = $seq +3;
}
//dummy
$objPHPExcel->getActiveSheet()->getStyle(getNameFromNumber($offset).$seq.':'.getNameFromNumber($offset+1).$seq)->getAlignment()->setWrapText(true);


$objPHPExcel->getProperties()->setCreator("MRC")->setLastModifiedBy("MRC");
$objPHPExcel->getActiveSheet()->setTitle('Report');
$name = 'Report_'.date("d-m-y", strtotime($_POST["date_from"])).'_to_'.date("d-m-y", strtotime($_POST["date_to"]));

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$name.'.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;