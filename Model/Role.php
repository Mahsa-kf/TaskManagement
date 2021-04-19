<?php


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