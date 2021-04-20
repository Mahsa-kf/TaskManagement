<?php
/*page -> add-member.php
       -> delete-member.php
       -> list-member.php
       -> update-member.php

 * method to retrieve data from role table*/

class Role
{
    public function getAllRoles($db)
    {
        $sql = "SELECT * FROM role";
        $pdostm = $db->prepare($sql);
        $pdostm->execute();
        $roles = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $roles;
    }


}