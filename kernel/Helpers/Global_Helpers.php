<?php

if (! function_exists('view')) {
    function view($view = null, $data = []): string
    {
        $Views = Views::getInstance()->make($view, $data);
        echo $Views;
        return $Views;
    }
}

if (! function_exists('extend')) {
    function extend($template = null)
    {
        Views::getInstance()->extendTemplate($template);
    }
}

if (! function_exists('startSection')) {
    function startSection($name = null)
    {
        Views::getInstance()->Section_Start($name);
    }
}

if (! function_exists('endSection')) {
    function endSection()
    {
        Views::getInstance()->Section_End();
    }
}

if (! function_exists('section')) {
    function section($name)
    {
        Views::getInstance()->renderSection($name);
    }
}