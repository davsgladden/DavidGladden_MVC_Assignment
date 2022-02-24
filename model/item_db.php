<?php

    function get_item_count() {
        global $db;
        // Get all items 
        $queryToDoItems = 'SELECT 
                            ItemNum,
                            Title,
                            Description,
                            t.CategoryID,
                            case when t.categoryID = -1 then "None" 
                                else c.categoryName end as Category
                            FROM todoitems t
                                left join categories c
                                on t.categoryID = c.categoryID
                            ORDER BY ItemNum';
        $statement = $db->prepare($queryToDoItems);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
    }
	function get_items($category_id) {
        global $db;
	    if ($category_id == -1) {
             // Get all items 
            $queryToDoItems = 'SELECT 
                                ItemNum,
                                Title,
                                Description,
                                t.CategoryID,
                                case when t.categoryID = -1 then "None" 
                                   else c.categoryName end as Category
                               FROM todoitems t
                                    left join categories c
                                    on t.categoryID = c.categoryID
                               ORDER BY ItemNum';
            $statement3 = $db->prepare($queryToDoItems);
            $statement3->execute();
            $toDoItems = $statement3->fetchAll();
            $statement3->closeCursor();
            return $toDoItems;
            } else {
                 // Get all items 
            $queryToDoItems = 'SELECT 
                                ItemNum,
                                Title,
                                Description,
                                t.CategoryID,
                                case when t.categoryID = -1 then "None" 
                                   else c.categoryName end as Category
                               FROM todoitems t
                                    left join categories c
                                    on t.categoryID = c.categoryID
                               Where t.categoryID = :category_id
                               ORDER BY ItemNum';
            $statement4 = $db->prepare($queryToDoItems);
            $statement4->bindValue(':category_id', $category_id);
            $statement4->execute();
            $toDoItems = $statement4->fetchAll();
            $statement4->closeCursor();
            return $toDoItems;
            }
        
     }

     function add_item($title, $description, $category_id) {
        global $db;
        // Add the product to the database  
        $query = 'INSERT INTO todoitems
                     (Title, Description, categoryID)
                  VALUES
                     (:title, :description, :category_id)';
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':category_id', $category_id);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
     }

	function delete_item($itemNum) {
		global $db;
		$count = 0;
		 $query = 'DELETE FROM todoitems
			       WHERE ItemNum = :id';
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $itemNum);
		if($statement->execute()) {
			$count = $statement->rowcount();
		}
		$statement->closeCursor();
		return $count;
	}

?>