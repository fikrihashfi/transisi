<?php

class Dasar{

    public function mean($nilai){
        $number = explode(" ", $nilai);
        $sum = 0;
        foreach($number as $n){
            $sum+=$n;
        }
        $mean = $sum/count($number);
        return $mean;
    }

    public function highest($nilai){
        $number = explode(" ", $nilai);
        $highest=0;
        foreach($number as $n){
            if($n > $highest){
                $highest = $n;
            }
        }

        return $highest;
    }

    public function lowest($nilai){
        $number = explode(" ", $nilai);
        if(count($number)>0){
            $lowest=$number[0];
        }
        foreach($number as $n){
            if($n < $lowest){
                $lowest = $n;
            }
        }

        return $lowest;
    }

}

$dasar = new Dasar();
$nilai = "72 65 73 78 75 74 90 81 87 65 55 69 72 78 79 91 100 40 67 77 86";
$dasar->lowest($nilai);


?>