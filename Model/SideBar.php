<?php
// design data driven nav links
class SideBar {
    private $sidenav;


    public function __construct($sidenav)
    {
        $this->sidenav = $sidenav;

    }
    public function display_SideNav()
    {
        $result='<ul class="nav flex-column">';

        for ($i = 0; $i < count($this->sidenav); $i++) {
            $result .= "<li class=\"nav-item\"><a class=\"nav-link active\"href=' . $i .'>" . $this->sidenav[$i] . "</a></li>";
        }
        $result .= '</ul>';

        return $result;

    }

}