<?php

class Hothothot extends Controller
{
    public function index()
    {
        $data['title'] = "🔥 HotHotHot";

        view('Hothothot/app', $data);
    }

    public function interior(){
        $data['title'] = "🔥 HotHotHot | Interior";
        $data['page_name'] = "Interior";

        view('Hothothot/interior', $data);
    }

    public function exterior(){
        $data['title'] = "🔥 HotHotHot | Exterior";
        $data['page_name'] = "Exterior";

        view('Hothothot/exterior', $data);
    }

    public function setting(){
        $data['title'] = "🔥 HotHotHot | Setting";
        $data['page_name'] = "Setting";

        view('Hothothot/setting', $data);
    }

    public function profile(){
        $data['title'] = "🔥 HotHotHot | Profile";
        $data['page_name'] = "Profile";

        view('Hothothot/profile', $data);
    }
}