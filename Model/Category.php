<?php

class Category
{
    public function getCategoryById($id, $db){
        $sql = "SELECT * FROM category where id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(PDO::FETCH_OBJ);
    }

    public function getAllCategories($db){
        $sql = "SELECT * FROM category";
        $pdostm = $db->prepare($sql);
        $pdostm->execute();

        $categories = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    public function addCategory($title, $description, $project_id, $creator_user_id, $db)
    {
        $sql = "INSERT INTO category (title, description, project_id, creator_user_id, created_date) 
              VALUES (:title, :description, :project_id, :creator_user_id, NOW()) ";
        $pst = $db->prepare($sql);

        $pst->bindParam(':title', $title);
        $pst->bindParam(':description', $description);
        $pst->bindParam(':project_id', $project_id);
        $pst->bindParam(':creator_user_id', $creator_user_id);
      

        $count = $pst->execute();
        return $count;
    }
       
    public function deleteCategory($id, $db){
        $sql = "DELETE FROM category WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;

    }

    public function updateCategory($id, $title, $description, $project_id, $creator_user_id, $db){
        $sql = "Update category
                set title = :title,
                description = :description,
                project_id = :project_id,
                creator_user_id = :creator_user_id
                WHERE id = :id
        ";

        $pst = $db->prepare($sql);

        $pst->bindParam(':title', $title);
        $pst->bindParam(':description', $description);
        $pst->bindParam(':project_id', $project_id);
        $pst->bindParam(':creator_user_id', $creator_user_id);
        $pst->bindParam(':id', $id);

        $count = $pst->execute();
        return $count;
    }
}
