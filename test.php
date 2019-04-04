<?php

$json = '{"1":"a","2":"b","3":"c","4":"d","5":"e"}';
 $obj = json_decode($json, TRUE);

foreach($obj as $key => $value)
{
echo 'Your key is: '.$key.' and the value of the key is:'.$value . "<br />";
}


?>
