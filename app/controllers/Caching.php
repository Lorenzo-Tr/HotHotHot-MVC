<?php

class Caching
{
    public function save()
    {
        CachingModel::save();
    }

    public function get_home(){
        echo CachingModel::get_home_data();
    }

    public function get_history(){
        echo CachingModel::get_history_data();
    }
}