<?php

class Caching
{
    public function save()
    {
        CachingModel::save();
    }

    public function get_data(){
        $data = CachingModel::get();
    }
}