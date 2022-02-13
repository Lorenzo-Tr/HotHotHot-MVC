<?php

class CachingModel
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

    static function get_home_data()
    {
        $db = new Database();

        $sqlRecentvalueExt = "SELECT Max(timestamp) as timestamp,value FROM `hot_cache` WHERE name='exterieur'";
        $sqlRecentvalueInt = "SELECT Max(timestamp) as timestamp,value FROM `hot_cache` WHERE name='interieur'";
        $qRecentvalueExt = $db->query($sqlRecentvalueExt);
        $qRecentvalueInt = $db->query($sqlRecentvalueInt);

        $sqlMinExt = "SELECT Min(value) FROM `hot_cache` WHERE name='exterieur'";
        $sqlMinInt = "SELECT Min(value) FROM `hot_cache` WHERE name='interieur'";
        $qMinExt = $db->query($sqlMinExt);
        $qMinInt = $db->query($sqlMinInt);

        $sqlMaxExt = "SELECT Max(value) FROM `hot_cache` WHERE name='exterieur'";
        $sqlMaxInt = "SELECT Max(value) FROM `hot_cache` WHERE name='interieur'";
        $qMaxExt = $db->query($sqlMaxExt);
        $qMaxInt = $db->query($sqlMaxInt);

        $arrayExt = $qRecentvalueExt->fetch(PDO::FETCH_OBJ);
        $arrayInt = $qRecentvalueInt->fetch(PDO::FETCH_OBJ);

        $array = [
            'interieur' => ["value" => $arrayInt->value, "timestamp" => $arrayInt->timestamp,"min" => $qMinInt->fetchColumn(), "max" => $qMaxInt->fetchColumn()],
            'exterieur' => ["value" => $arrayExt->value, "timestamp" => $arrayExt->timestamp,"min" => $qMinExt->fetchColumn(), "max" => $qMaxExt->fetchColumn()],
        ];


        return json_encode($array);
    }

    static function get_history_data(){
        $db = new Database();

        $sql = "SELECT `value`, `timestamp`, `name` FROM `hot_cache` WHERE cast(timestamp as Date) = cast(NOW() as Date)";
        $q = $db->query($sql);

        $array = $q->fetchAll();

        return json_encode($array);
    }
}