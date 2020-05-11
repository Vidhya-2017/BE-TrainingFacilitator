<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
 ini_set('display_errors', 0);
?>

<!doctype>
<html>
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
var _validFileExtensions = [".xls", ".xlsx", ".csv"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
</script>
</head>
<body>
<div class="container">

<?php

if(isset($_FILES['excel']) && $_FILES['excel']['error']==0) {
		require_once "PHPExcel/Classes/PHPExcel.php";
		$tmpfname = $_FILES['excel']['tmp_name'];
		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
		// $excelReader->setPreCalculateFormulas(true);
		$excelReader->setLoadAllSheets();
		$objPHPExcel = $excelReader->load($tmpfname);
		$objWorksheet = $objPHPExcel->getActiveSheet();
$CurrentWorkSheetIndex = 0;

foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    // echo 'WorkSheet' . $CurrentWorkSheetIndex++ . "\n";
    echo '<br><br><br>Worksheet Name - ', $objPHPExcel->getSheetByName($worksheet), PHP_EOL;
	$sheetname = $worksheet->getTitle();
	echo $sheetname;
    $highestRow = $worksheet->getHighestDataRow();
    $highestColumn = $worksheet->getHighestDataColumn();
    $headings = $worksheet->rangeToArray('A1:' . $highestColumn . 1,
        NULL,
        TRUE,
        FALSE);
		
		if($sheetname != 'Sheet'){  
			
			$highestRow = $worksheet->getHighestRow();
			$highestColumn = $worksheet->getHighestColumn();
			 $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			 $val=array();
			for ($row = 2; $row <= $highestRow; ++ $row) {
				$allvalue = array();
			for ($col = 0; $col < $highestColumnIndex; ++ $col) {
			   $cell = $worksheet->getCellByColumnAndRow($col, $row);
			   $allvalue[] = $cell->getValue();
			 //End of For loop   
			}
			   $val[] = $allvalue;
			}
		  echo "<pre>";
		  print_R($val);
		  echo "</pre>";

		}else{
			
				// echo "<pre>";
					// for ($row = 2; $row <= $highestRow; $row++) {
					   
						// $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
						// $worksheet->getCell('k19'.$row->getRowIndex())->getValue() ;
						// // $rowData[0] = array_combine($headings[0], $rowData[0]);
						// // echo $sheet->getCell($highestColumn[$row].$row->getRowIndex())->getValue() ;
						
						// print_r($rowData);
						


					// }
					
				// echo "</pre>";
			
		}
}


		// $objWorksheet = $objPHPExcel->getActiveSheet();
		
		
		// echo '<table>' . "\n";
			// foreach ($objWorksheet->getRowIterator() as $row) {
			  // echo '<tr>' . "\n";

			  // $cellIterator = $row->getCellIterator();
			  // $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
																 // // even if it is not set.
																 // // By default, only cells
																 // // that are set will be
																 // // iterated.
			  // foreach ($cellIterator as $cell) {
				// echo '<td>' . $cell->getValue() . '</td>' . "\n";
			  // }

			  // echo '</tr>' . "\n";
			// }
			// echo '</table>' . "\n";


		 // $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		
		
		// $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		// echo ' Highest Column ' . $getHighestColumn = $objPHPExcel->setActiveSheetIndex()->getHighestColumn(); // Get Highest Column
		// echo ' Get Highest Row ' . $getHighestRow = $objPHPExcel->setActiveSheetIndex()->getHighestRow(); // Get Highest Row

		// echo "<pre>";
		// print_r($sheetData);
		// echo "</pre>";
	
		//$worksheet = $excelObj->getSheet(0);
		//$lastRow = $worksheet->getHighestRow();
		
		// echo "<table class=\"table table-sm\">";
		// for ($row = 1; $row <= $lastRow; $row++) {
			 // echo "<tr><td scope=\"row\">";
			 // echo $worksheet->getCell('A'.$row)->getValue();
			 // echo "</td><td>";
			 // echo $worksheet->getCell('B'.$row)->getValue();
			 // echo "</td><td>";
			 // echo $worksheet->getCell('C'.$row)->getValue();
			 // echo "</td><td>";
			 // echo $worksheet->getCell('D'.$row)->getValue();
			 // echo "</td><tr>";
		// }
		// echo "</table>";	
}
?>
<div class="container">
<form action = "" method = "POST" enctype = "multipart/form-data">
         <input type = "file" name = "excel" onchange="ValidateSingleInput(this)" />
         <input type = "submit"/>
</form>
</div>
</div>

</body>
</html>