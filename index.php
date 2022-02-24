<?php
require_once('model/database.php');
require_once('model/category_db.php');
require_once('model/item_db.php');

	$itemNum = filter_input(INPUT_POST, 'itemNum', FILTER_VALIDATE_INT);

	$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
	if(!$action) {
		$action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
		if(!$action) {
			$action = 'list_items';
		}
	}

	// Get category ID
if ($action == 'list_items') {
    $category_id = filter_input(INPUT_GET, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = -1;
    }
	$category_name = get_categoryName($category_id);
	$categories = get_categories();
	$toDoItems = get_items($category_id);
	$itemCount = get_item_count();
	include('view/item_list.php');

} else if ($action == 'delete_item') {
	$itemNum = filter_input(INPUT_POST, 'itemNum', FILTER_VALIDATE_INT);
	if ($itemNum == NULL || $itemNum == FALSE) {
		$error_message = "Missing or incorrect ItemNum.";
		include('view/error.php');
	} else {
		$count = delete_item($itemNum);
		header("Location: .?category_id=$category_id&deleted={$count}");
	}

} else if ($action == 'delete_category') {
	$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
	if ($category_id == NULL || $category_id == FALSE) {
		$error_message = "Missing or incorrect CategoryID.";
		include('view/error.php');
	} else {
		$count = delete_category($category_id);
		header("Location: .?action=list_categories&deleted={$count}");
	}

} else if ($action== 'list_categories') {
	$categories = get_categories();
	include('view/category_list.php');

} else if ($action== 'add_item_form') {
	$categories = get_categories();
	include('view/add_item_form.php');

} else if ($action == 'add_item') {
	$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
	$title = filter_input(INPUT_POST, 'title', FILTER_UNSAFE_RAW);
	$description = filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW);
	if ($category_id == NULL || $category_id == FALSE || $title == NULL || $description == NULL) {
		$error_message = "Invalid data. Check all fields and try again.";
		include('view/error.php');
	} else {
		$count = add_item($title, $description, $category_id);
		header("Location: .?category_id=-1&created={$count}");
	}

} else if ($action == 'add_category') {
	$category_name = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW);
	if ($category_name == NULL) {
		$error_message = "Invalid data. Check all fields and try again.";
		include('view/error.php');
	} else {
		$count = insert_category($category_name);
		header("Location: .?action=list_categories&created={$count}");
	}
}

?>



