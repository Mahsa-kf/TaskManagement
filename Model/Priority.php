<?php

class Priority
{
    public function getPriorities($db){
        $sql = "SELECT * FROM priority";
        $pdostm = $db->prepare($sql);
        $pdostm->execute();

        $priorities = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $priorities;
    }
}
