<?php include('header.php'); ?>
    <?php 
    if (!empty($categories)) { ?>
        <table>
            <tr>
                <th>Name</th>
                <th>&nbsp;</th>
            </tr>        
            <?php foreach ($categories as $category) : ?>
            <tr>
                <td><?php echo $category['categoryName']; ?></td>
                <td>
                    <form action="index.php" method="post" id="delete_category">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="category_id" value="<?php echo $category['categoryID']; ?>"/>
                        <input type="submit" value="Delete"/>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>    
        </table>
    <?php } else { ?>
	    <p style="font-weight:bold">No category items exist. Please add a category!</p><br><br>
	<?php } ?>

    <h2 class="margin_top_increase">Add Category</h2>
    <form action="index.php" method="post" id="add_category_form">
        <input type="hidden" name="action" value="add_category">
        <label>Name:</label>
        <input type="text" name="name" />
        <input id="add_category_button" type="submit" value="Add"/>
    </form>
    
    <p><a href="index.php">View To Do List</a></p>
    <?php include('status.php'); ?>
    <br>
<?php include('footer.php'); ?>