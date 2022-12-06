<?php 
echo nl2br("Hello :\n") ;
foreach($data['test'] as $row)
        {
            echo nl2br($row['username'] . " : " . $row['password'] . "\n");
        }
?>

