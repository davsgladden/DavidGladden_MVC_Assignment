<?php include('header.php') ?>

    <aside>
        <!-- display a list of categories -->
        <h2>Categories:</h2>
        <form name="myform" action="index.php" method="post">
        <select name="categories" id="categories" onchange="window.location.href = this.value">
            <option value="default">Select a category:</option>
        <?php foreach ($categories as $category) : ?>
            <option value=".?category_id=<?php echo $category['categoryID']; ?>"> 
                    <?php echo $category['categoryName']; ?>
            </option>
        <?php endforeach; ?>
        </select>         
        </form>
    </aside>
    <h2><?php echo $category_name; ?></h2>
   <?php 
        if ($toDoItems) { ?>
            <section>
                <!-- display a table of products -->
                <table>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>&nbsp;</th>
                    </tr>

                    <?php foreach ($toDoItems as $items) : ?>
                            <tr>
                                <td><?php echo $items['Title']; ?></td>
                                <td><?php echo $items['Description']; ?></td>
                                <td><?php echo $items['Category']; ?></td>
                                <td>
                                    <form action="." method="post">
                                        <input type="hidden" name="action" value="delete_item">
                                        <input type="hidden" name="itemNum" value="<?php echo $items['ItemNum']; ?>">
                                        <input type="hidden" name="category_id" value="<?php echo $items['CategoryID']; ?>">
                                        <input type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                </table>
		<?php } else if ($itemCount>=1) {?>
            <p style="font-weight:bold">No to do list items exist for this category. Please select a different category.</p><br><br>
        <?php } else {?>
		    <p style="font-weight:bold">No to do list items exist. You're all caught up!</p><br><br>
		<?php } ?>
                <p><a href="?action=add_item_form">Add Item</a></p>
                <p><a href="?action=list_categories">List Categories</a></p>        
            </section>
            <br>
    <?php include('status.php'); ?>
    <br>
<?php include('footer.php') ?>