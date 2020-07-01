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

    public function meanHighestLowest($nilai){
        echo "Nilai : ".$nilai."<br>";
        echo 'Mean : '.$this->mean($nilai).', Highest : '.$this->highest($nilai).', Lowest : '.$this->lowest($nilai);
    }

    public function countLowerCase($sentence){
        preg_match_all('/[a-z]/', $sentence, $matches);
        return $matches[0];
    }

    public function unigram($sentence){
        $result = str_replace(' ', ', ', $sentence);
        return strtolower($result); 
    }

    public function bigram($sentence){
        $word = explode(" ", $sentence);
        $result = "";
        foreach($word as $idx => $w){
            if($idx%2==1&&$idx!=count($word)-1){
                $result.=$w.", ";
            }
            else if($idx%2==0 && $idx!=0){
                $result.=$w." ";
            }
            else{
                $result.=$w." ";
            }
        }

        return strtolower($result);
    }

    public function trigram($sentence){
        $word = explode(" ", $sentence);
        $result = "";
        foreach($word as $idx => $w){
            if($idx%3==2&&$idx!=count($word)-1){
                $result.=$w.", ";
            }
            else if(($idx%3==0 || $idx%3==1) && $idx!=0){
                $result.=$w." ";
            }
            else{
                $result.=$w." ";
            }
        }

        return strtolower($result);
    }

    public function uniBiTriGram($sentence){
        echo 'Unigram : '.$this->unigram($sentence).'<br>
        Bigram : '.$this->bigram($sentence).'<br>
        Trigram : '.$this->trigram($sentence);
    }

    public function table(){
        $increment=0;
        echo "<table cellspacing='0' cellpadding='0'>";
        for($i=1; $i<=8; $i++){
            echo "<tr>";
                for($j=1; $j<=8; $j++){
                    $increment++;
                    if($increment%3==0||$increment%4==0){
                        echo "<td style='text-align:center; width:50px; height:50px;'>$increment</td>";
                    }
                    else{
                        echo "<td style='border: 1px solid black; background-color:black; width:50px; 
                        height:50px; color:white;text-align:center;'>$increment</td>";
                    }
                }
            echo "</tr>";
        }
        echo "</table>";
    }

}

$dasar = new Dasar();
$nilai = "72 65 73 78 75 74 90 81 87 65 55 69 72 78 79 91 100 40 67 77 86";
$sentence = "Jakarta adalah ibukota negara Republik Indonesia";
// $dasar->meanHighestLowest($nilai);
// $dasar->uniBiTriGram($sentence);
$dasar->table();


?>