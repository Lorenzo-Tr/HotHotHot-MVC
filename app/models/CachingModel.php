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

    static function get()
    {
        /*TODO
        { interior : { value : 16.2, min: 2, max: 20}
        */
        $db = new Database();


        $sqlRecentvalueExt = "SELECT Max(timestamp),value FROM `hot_cache` WHERE name='exterieur'";
        $sqlRecentvalueInt = "SELECT Max(timestamp),value FROM `hot_cache` WHERE name='interieur'";
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
        

        $arrayExt = [];
        while($row =mysqli_fetch_assoc($qRecentvalueExt))
        {
            $arrayExt[] = $row;
        }

        $arrayInt = [];
        while($row =mysqli_fetch_assoc($qRecentvalueInt))
        {
            $arrayInt[] = $row;
        }

        $array = [
            'interieur' => ["value" => $arrayInt[1], "timestamp" => $arrayInt[0],"min" => mysqli_fetch_assoc($qMinInt),"max" => mysqli_fetch_assoc($qMaxInt)],
            'exterieur' => ["value" => $arrayExt[1], "timestamp" => $arrayExt[0],"min" => mysqli_fetch_assoc($qMinExt),"max" => mysqli_fetch_assoc($qMaxExt)],
        ];


        return json_encode($array);
    }
}