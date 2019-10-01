<?php
function read_csv($filename){
    $keys = array();
    $values = array();
    $row = 0;
    if (($handle = fopen("test.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            $value = array();
            $row++;
            for ($c=0; $c < $num; $c++) {
                if($row == 1){
                    array_push($keys, $data[$c]);
                } else {
                    $value[$keys[$c]] = $data[$c];
                }
            }
            
            if($row != 1){
                array_push($values, $value);
            }
        }
        fclose($handle);
    }
    return $values;
}