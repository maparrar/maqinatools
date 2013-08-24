<?php
        $ini=microtime(true);
        $n=100000000;
        for($i=0;$i<$n;$i++){
                $resp=10*20;
        }
        $end=microtime(true);
        echo "Time: ".sprintf('%f',$end-$ini)." ms \n";
?>
