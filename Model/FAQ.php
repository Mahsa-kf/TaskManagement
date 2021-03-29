<?php
// namespace TaskManagement\Model;

class FAQ
{

    // Get FAQ data
    public function getFAQ($db){

        $sql = "SELECT * FROM faq";

        // Prepares a statement for execution and returns a statement object
        $pdostm = $db->prepare($sql);
        
        // Execute
        $pdostm->execute();

        //Fetch a result row as an associative array
        return $faq = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
        
    }
    

    public function getFAQBySearch($search, $db){
     

        $sql = "SELECT * FROM faq WHERE question LIKE :search";

        $keyword = "%".$search."%";

        // Prepares a statement for execution and returns a statement object
        $pdostm = $db->prepare($sql);

        //Binds a parameter to the specified variable name
        $pdostm->bindParam(':search' , $keyword);

        // Execute
        $pdostm->execute();

        //Fetch a result row as an associative array
        return $faq = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
        
    }

    // Get faq data by category
    public function getFAQByCategory($category, $db){
     
        $sql = "SELECT * FROM faq WHERE category = :category";

        // Prepares a statement for execution and returns a statement object
        $pdostm = $db->prepare($sql);

        //Binds a parameter to the specified variable name
        $pdostm->bindParam(':category' , $category);
       
        // Execute
        $pdostm->execute();

        //Fetch a result row as an associative array
        return $faq = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
        
    }
    
}