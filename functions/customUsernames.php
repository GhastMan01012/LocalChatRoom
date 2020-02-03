<?php
function rainbow($string) {
    $x = str_split($string);
    $j = 1;
    $newString  = "";
    for($i = 0; $i < count($x); $i++) {
        if($j == 1) {
            $newString = $newString . "<a style='color:rgb(255,0,0)'>" . $x[$i] . "</a>";
            $j++;
        } elseif($j == 2) {
            $newString = $newString . "<a style='color:rgb(255,127,0)'>" . $x[$i] . "</a>";
            $j++;
        } elseif($j == 3) {
            $newString = $newString . "<a style='color:rgb(255,255,0)'>" . $x[$i] . "</a>";
            $j++;
        } elseif($j == 4) {
            $newString = $newString . "<a style='color:rgb(0,255,0)'>" . $x[$i] . "</a>";
            $j++;
        } elseif($j == 5) {
            $newString = $newString . "<a style='color:rgb(0,0,255)'>" . $x[$i] . "</a>";
            $j++;
        } elseif($j == 6) {
            $newString = $newString . "<a style='color:rgb(255,0,255)'>" . $x[$i] . "</a>";
            $j = 1;
        }
    }
    return $newString;
}
?>