<?php

class Caching
{
    static function save()
    {
        $data = json_decode($_POST['data']);

        $interior = $data->capteurs[0];
        $exterior = $data->capteurs[1];

        $date = date_create();

        $db = new Database();

        $sql = "INSERT INTO `hot_cache` (id, value, timestamp, name) VALUES (NULL, :interiorValue, :interiorTimestamp , :interiorName), (null, :exteriorValue, :exteriorTimestamp , :exteriorName)";

        $q = $db->query($sql, [
            "interiorValue" => $interior->Valeur,
            "interiorTimestamp" => date('Y/m/d H:i:s', $interior->Timestamp),
            "interiorName" => $interior->Nom,
            "exteriorValue" => $exterior->Valeur,
            "exteriorTimestamp" => date('Y/m/d H:i:s', $exterior->Timestamp),
            "exteriorName" => $exterior->Nom,
        ]);
    }
}