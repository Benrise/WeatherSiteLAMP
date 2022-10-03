<?php
global $sorted;
if(isset($_GET["toSort"])){
    $unsorted = $_GET["toSort"];
    $unsorted = explode(" ", $unsorted);

//    natsort($unsorted);
//    print_r($unsorted);
//    $sorted = $unsorted;

    $sorted = ShellSort($unsorted, count($unsorted));

}




function ShellSort($elements,$length) {
    $k=0;
    $gap[0] = (int) ($length / 2);

    while($gap[$k] > 1) {
        $k++;
        $gap[$k]= (int)($gap[$k-1] / 2);
    }//end while

    for($i = 0; $i <= $k; $i++){
        $step=$gap[$i];

        for($j = $step; $j < $length; $j++) {
            $temp = $elements[$j];
            $p = $j - $step;
            while($p >= 0 && $temp < $elements[$p]) {
                $elements[$p + $step] = $elements[$p];
                $p= $p - $step;
            }//end while
            $elements[$p + $step] = $temp;
        }//endfor j
    }//endfor i

    return $elements;
}// end function

// Exmaple
// $SortedElements=shellsort($UnsortedElements,length of list(an integer));
// e.g: $elements=shellsort($elements,10);
include ('shellSort.php');