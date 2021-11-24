<?php
final class Converter{
  public static function jsonToArray($json){
    return json_decode($json);
  }

  public static function csvToArray($csv){
    $A_csv = array_map('str_getcsv', $csv);
    $csv = [];
    foreach ($A_csv as $key => $value) {
      $obj = new StdClass();
      $obj->civility = $value[0];
      $obj->last_name = $value[1];
      $obj->first_name = $value[2];
      array_push($csv, $obj);
    } 

    return $csv;
  }
}