<?php
class Upload{
  public static function getUploadedFile($inputName){
    if(isset($_FILES[$inputName]) && !empty($_FILES[$inputName]['tmp_name'])){
      if($_FILES[$inputName]['type'] == 'application/json'){
        $students = Converter::jsonToArray(file_get_contents($_FILES[$inputName]['tmp_name']));
      }elseif ($_FILES[$inputName]['type'] == 'application/vnd.ms-excel') {
        $students = Converter::csvToArray(file($_FILES[$inputName]['tmp_name']));
      }else{
        return null;
      }
      return $students;
    }else{
      return null;
    }
  }
}