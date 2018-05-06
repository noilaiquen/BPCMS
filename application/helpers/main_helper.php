<?php

/**************************** BEGIN: EXCEL HELPER ***************************/
if ( ! function_exists('get_excel_object'))
{
	function get_excel_object() {
		/** PHPExcel */
		require_once 'PHPExcel/Classes/PHPExcel.php';
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		return $objPHPExcel;
	}
}

if ( ! function_exists('load_excel_file'))
{
	function load_excel_file($file_path) {
		/** PHPExcel */
		require_once 'PHPExcel/Classes/PHPExcel.php';

		// Include ezSQL core
		include_once "PHPExcel/ez_sql_core.php";

		// Include ezSQL database specific component
		include_once "PHPExcel/ez_sql_mysql.php";

		$objPHPExcel = PHPExcel_IOFactory::load($file_path);
		return $objPHPExcel;
	}
}
if ( ! function_exists('load_excel_file_xml'))
{
	function load_excel_file_xml($file_path) {
		require_once 'PHPExcel/Classes/PHPExcel.php';
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		// $objReader->setLoadSheetsOnly(array("HCM"));
		// $objReader = PHPExcel_IOFactory::createReaderForFile($file_path);
		$objReader->setReadDataOnly(true);
		$worksheetNames = $objReader->listWorksheetNames($file_path);
		foreach ($worksheetNames as $sheetName) {
			pr($sheetName);
		}
		$objReader->setLoadSheetsOnly(array($worksheetNames[0]));

		$objPHPExcel = $objReader->load($file_path); // Extremely slow/ Bad performance -> Allowed memory size of xxx bytes exhausted
		return $objPHPExcel;
	}
}
if ( ! function_exists('phpexcel_get_obj_reader'))
{
	function phpexcel_get_obj_reader($for_reading=true) {
		require_once 'PHPExcel/Classes/PHPExcel.php';
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		if($for_reading){
			$objReader->setReadDataOnly(true);
		}
		return $objReader;
	}
}

if ( ! function_exists('excel_write_cell'))
{
	function excel_write_cell($sheet,$col,$row,$value) {
		$cell_address = $col.$row;
		$sheet->setCellValue($cell_address, $value);
	}
}

if ( ! function_exists('num2alpha'))
{
	function num2alpha($n)
	{
		for($r = ""; $n >= 0; $n = intval($n / 26) - 1)
			$r = chr($n%26 + 0x41) . $r;
		return $r;
	}
}
if ( ! function_exists('stringFromColumnIndex'))
{
	function stringFromColumnIndex($index)
	{
		require_once 'PHPExcel/Classes/PHPExcel.php';
		return PHPExcel_Cell::stringFromColumnIndex($index);
	}
}

if ( ! function_exists('excel_get_cell_address'))
{
	function excel_get_cell_address($column,$row)
	{
		$address = num2alpha($column).$row;
		return $address;
	}
}

if ( ! function_exists('excel_duplicate_formula'))
{
	function excel_duplicate_formula($start_row,$row,$formula){
		$duplicate_formula = str_replace($start_row,$row,$formula);
		return $duplicate_formula;
	}
}

if ( ! function_exists('excel_format_percentage'))
{
	function excel_format_percentage($objSheet,$column,$row){
		$objSheet->getStyle(excel_get_cell_address($column,$row))->getNumberFormat()->applyFromArray(
			array(
				'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
			)
		);
	}
}

if ( ! function_exists('excel_get_column_index'))
{
	function excel_get_column_index($column_name)
	{
		$index = 0;
		if(!empty($column_name)){
			require_once 'PHPExcel/Classes/PHPExcel.php';
			$index = PHPExcel_Cell::columnIndexFromString($column_name)-1;
		}
		return $index;
	}
}
/**************************** END: EXCEL HELPER ***************************/


/*BEGIN: IMPORT*/
function import_check_column_header($column_name,$checked_header,$rowData){
	$result = false;
	if(!empty($column_name) && !empty($rowData)){
		$col = excel_get_column_index($column_name);
		$column_header = !empty($rowData[$col]) ? SEO(trim($rowData[$col])) : '';
		$checked_header = SEO($checked_header);
		if($column_header == $checked_header){
			$result = true;
		}
	}
	return $result;
}
/*END: IMPORT*/


function is_localhost() {
    $result = false;
    if(defined('IS_LOCALHOST')){
        $result = IS_LOCALHOST;
    } else {
        $whitelist = array( '127.0.0.1', '::1' );
        if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
            $result = true;
        }
    }
    return $result;
}

/*BEGIN: GET RESOURCE URL */
function get_resource_url ($path = null)
{
	$url = PATH_URL . $path;
	$path_full = BASEFOLDER . $path;
	if (function_exists('filemtime')) {
		if (file_exists($path_full)) {
			$url .= '?r=' . filemtime($path_full);
		}
	}
	return $url;
}
/*END: GET RESOURCE URL */

function get_full_path ($path = null)
{
	return trim(rtrim(PATH_URL, '/\\') . '/' . ltrim($path, '/\\'));
}

if(!function_exists('mapping')){
	function mapping($data, $key = NULL, $value = NULL, $lower = false){
		$return_data = array();

		if(!empty($data) && !empty($key)){
			foreach ($data as $val) {
				if($lower){
					$main_key = strtolower($val[$key]);
				}else{
					$main_key = $val[$key];
				}

				if(!empty($value)){
					$return_data[$main_key] = $val[$value];
				}else{
					$return_data[$main_key] = $val;
				}
			}
		}

		return $return_data;
	}
}