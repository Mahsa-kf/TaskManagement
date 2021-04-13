<?php


class Role
{
    public function getAllRoles($db){
        $sql = "SELECT * FROM role";
        $pdostm = $db->prepare($sql);
        $pdostm->execute();
        $roles = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $roles;
    }

    function populateRoles($roles, $select = ""){
        $html_dropdown = "";
        foreach ($roles as $role) {
            $selected = ($select == $roles->role) ? "selected" : "";
            $html_dropdown .= "<option $selected value='$role->id> $role->description</option>";
        }

        return $html_dropdown;
    }

}