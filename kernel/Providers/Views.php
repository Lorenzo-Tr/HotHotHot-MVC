<?php

class Views
{
    protected $layout;

    protected $sections = [];

    protected $currentSection;

    protected $sectionStack = [];

    private static $_instance;

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new Views();
        }
        return self::$_instance;
    }

    function make(string $view, array $data = [])
    {
        if (!isset($_SESSION))
            session_start();
        $output = (function ($data, $view): string {
            extract($data);
            ob_start();
            include Constants::getViewPath() . $view . '.php';

            return ob_get_clean() ?: '';
        })($data, $view);

        if ($this->layout !== null){
            $layoutView = $this->layout;
            $this->layout = null;

            $output = $this->make($layoutView, $data);
        }

        return $output;
    }

    function extendTemplate(string $template){
        $this->layout = $template;
    }

    function Section_Start($name){
        $this->currentSection = $name;
        $this->sectionStack[] = $name;

        ob_start();
    }

    function Section_End(){
        $contents = ob_get_clean();

        if ($this->sectionStack === []) {
            throw new RuntimeException('View themes, no current section.');
        }

        $section = array_pop($this->sectionStack);

        // Ensure an array exists so we can store multiple entries for this.
        if (! array_key_exists($section, $this->sections)) {
            $this->sections[$section] = [];
        }

        $this->sections[$section][] = $contents;
    }

    public function renderSection(string $sectionName)
    {
        if (! isset($this->sections[$sectionName])) {
            echo '';

            return;
        }

        foreach ($this->sections[$sectionName] as $key => $contents) {
            echo $contents;
            unset($this->sections[$sectionName][$key]);
        }
    }
}