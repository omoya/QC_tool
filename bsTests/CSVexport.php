<?php
$file = "QCexport2.csv";
$myString = ", I am going home.";
file_put_contents($file,"Hello");
$getData = file_get_contents($file);
echo $getData;

?>