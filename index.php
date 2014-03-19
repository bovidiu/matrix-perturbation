<?php
echo '<pre>';


function getArray(){
$array = explode( "\n", file_get_contents( 'matrix.txt' ) );
	return $array;
}

//get row values from a given row
function getRows($argRowNo){
	$arr = getArray();
	return $arr[$argRowNo];
}
//get individual row values
function getRowValues($argRow){
	$arr = getRows($argRow);
	return explode(" ",$arr);
}

//pertubation increment
function pertubValueIncrement(){
	$values=array();
	for ($i=-1; $i <= 1 ; $i+=0.1) {
		$values[] = $i;
	}
	return $values;
}
//
function perturbRowTwo(){
	//get all values from row 2 (book)
	$getSecondRowValue = getRowValues(1);
	//get perturbation array
	$getPerturbationArray = pertubValueIncrement();


	$newRowValue=array();
	$groupValue=array();

	foreach ($getPerturbationArray as $key => $value) {
		
		for ($i=0; $i <count($getSecondRowValue) ; $i++) { 
			if($getSecondRowValue[$i] >= 0){
				if($getPerturbationArray[$key] <= 0){
					$newRowValue[$i] = $getSecondRowValue[$i]+ ($getPerturbationArray[$key] * $getSecondRowValue[$i] );
				}else{
					$newRowValue[$i] = $getSecondRowValue[$i]+ ($getPerturbationArray[$key] * (1-$getSecondRowValue[$i]));
				}
			}
		}
	$groupValue[$key] = $newRowValue;
	}

return $groupValue;

}



function perturbRowThree(){
	//get all values from row 3 (book)
	$getThirdRowValue = getRowValues(2);
	//get perturbation array
	$getPerturbationArray = pertubValueIncrement();


	$newRowValue=array();
	$groupValue=array();

	foreach ($getPerturbationArray as $key => $value) {
		
		for ($i=0; $i <count($getThirdRowValue) ; $i++) { 
			if($getThirdRowValue[$i] >= 0){
				if($getPerturbationArray[$key] <= 0){
					$newRowValue[$i] = $getThirdRowValue[$i]+ ($getPerturbationArray[$key] * $getThirdRowValue[$i] );
				}else{
					$newRowValue[$i] = $getThirdRowValue[$i]+ ($getPerturbationArray[$key] * (1-$getThirdRowValue[$i]));
				}
			}
		}
	$groupValue[$key] = $newRowValue;
	}

return $groupValue;

}

function perturbationThridRow(){
	$getSecondRowResults =perturbRowTwo();

	$testArr=array();

	foreach ($getSecondRowResults as $key => $value) {
		$testArr[$key]=perturbRowThree();
	}

	return $testArr;
}

function countValuesBasedOnRowTwo(){
	$row2Perturb = perturbRowTwo();//=21 valori
	//get nr of arrays
$sum = array();
$test = array();
	for($i = 0; $i< count($row2Perturb);$i++){
		//get no of entries per row
		//$sum[] = sumElements($i) + $row2Perturb[$i];
		$test[] = $row2Perturb[$i];
		
		for ($j=0; $j < count($test[$i]) ; $j++) { 
			$sum[] = sumElements($j) + $test[$i][$j] ;
		}
		
	}
	print_r($sum);
	// print_r($sum);
}

function sumElements($i){
	$row1 = getRowValues(0);
	$row4 = getRowValues(3);
	$row5 = getRowValues(4);
	$row6= getRowValues(5);
	$sumRow = $row1[$i] + $row4[$i] +$row5[$i] +$row6[$i];	
	return $sumRow;   
}

print_r(countValuesBasedOnRowTwo()) ;