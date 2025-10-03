<?php
require_once "../classes/product.php";
$productObj = new Product();
$books = $productObj->viewProduct();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>View Books</h1>

    <div class="top-bar">
        <a href="/project/product/addproduct.php" class="btn btn-success">Add New Book</a>
    </div>

    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Publication Year</th>
            <th>Actions</th>
        </tr>
        <?php if ($books): ?>
            <?php foreach ($books as $product): 
                $message = "Are you sure you want to delete this book?";
                $product = (array)$product; 
            ?>
            <tr>
                <td><?= htmlspecialchars($product["title"]) ?></td>
                <td><?= htmlspecialchars($product["author"]) ?></td>
                <td><?= htmlspecialchars($product["genre"]) ?></td>
                <td><?= htmlspecialchars($product["publicationYear"]) ?></td>
                <td>
                    <a href="/project/product/editproduct.php?id=<?= $product['id'] ?>" class="btn btn-warning">Edit</a>
                    <a href="/project/product/deleteproduct.php?id=<?= $product['id'] ?>" 
                       class="btn btn-danger"
                       onclick="return confirm('<?= $message ?>')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center; color:#777;">No books found.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>
