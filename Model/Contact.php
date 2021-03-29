
<?php
// namespace TaskManagement\Model;

class Contact
{

    // Register data from contact us page
    public function addContactInfoPublic($name, $email_address, $phone_number, $subject, $message, $db)
    {

        $sql = "INSERT INTO contact_info_public (name, email_address, phone_number, subject, message) values (:name, :email_address, :phone_number, :subject, :message )";

        //Prepares a statement for execution and returns a statement object
        $pdostm = $db->prepare($sql);

        //Binds a parameter to the specified variable name
        $pdostm->bindParam(':name' , $name );
        $pdostm->bindParam(':email_address' , $email_address );
        $pdostm->bindParam(':phone_number' , $phone_number );
        $pdostm->bindParam(':subject' , $subject );
        $pdostm->bindParam(':message' , $message );

        //Execute
        $count = $pdostm->execute();

        return $count;
    }
}