<?php

function populateProjectUser($project_users, $select = ""){
    $html_dropdown = "";
    foreach ($project_users as $project_user) {
        $selected = ($select == $project_user->project_user) ? "selected" : "";
        $html_dropdown .= "<option $selected value='$project_user->id'>$project_user->first_name $project_user->last_name</option>";
    }

    return $html_dropdown;
}

/*function checkboxProjectUser($project_users){
    $html_checkbox = "";
    foreach ($project_users as $project_user) {
        $checked = (isset($project_user_selected) && $project_user == $project_user_selected ? " checked=\\"checked\\"" : '');
	    $$html_checkbox .=
    }

    return $html_checkbox;
}*/
