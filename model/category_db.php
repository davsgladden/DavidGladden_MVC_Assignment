<?php 
    // Get all categories
    function get_categories() {
        global $db;
        $query = 'SELECT * FROM categories 
                  UNION 
                  SELECT -1, "All"
                  ORDER BY categoryID';
        
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        $statement->closeCursor();
        return $categories;
     }

     // Get name for selected category
     function get_categoryName($category_id) {
        global $db;
        $queryCategory = 'SELECT * FROM categories
                          WHERE categoryID = :category_id';

        $statement1 = $db->prepare($queryCategory);
        $statement1->bindValue(':category_id', $category_id);
        $statement1->execute();
        $category = $statement1->fetch();
        $category_name = $category['categoryName'] ??= "All";
        $statement1->closeCursor();
        return $category_name;
      }

    // Add the category to the database  
    function insert_category($name) {
        global $db;
        $query = 'INSERT INTO categories (categoryName)
                  VALUES (:category_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_name', $name);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
    }

    // Delete category from database
    function delete_category($category_id) {
        global $db;
        $query = 'DELETE FROM categories 
                  WHERE categoryID = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
    }

?>