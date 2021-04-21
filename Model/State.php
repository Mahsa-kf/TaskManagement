<?php

class State
{
    public function getStates($db){
        $sql = "SELECT * FROM state";
        $pdostm = $db->prepare($sql);
        $pdostm->execute();

        $states = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $states;
    }
}
