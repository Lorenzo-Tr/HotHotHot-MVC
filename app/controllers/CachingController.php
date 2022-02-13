<?php

class CachingController extends Controller
{
    public function save()
    {
        CachingModel::save();
    }

    public function get_home(){
        echo CachingModel::get_home_data();
    }

    public function get_interior_history(){
        echo CachingModel::get_interior_history_data();
    }

    public function get_exterior_history(){
        echo CachingModel::get_exterior_history_data();
    }
}