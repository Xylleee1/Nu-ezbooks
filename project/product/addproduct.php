<?php
require_once "../classes/product.php";

//asspciative array to hold form data and errors
$productData = ["title" => "", "author" => "", "genre" => "", "publicationYear" => ""];
$errors = ["title" => "", "author" => "", "genre" => "", "publicationYear" => ""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productData["title"] = trim(htmlspecialchars($_POST["title"] ?? ""));
    $productData["author"] = trim(htmlspecialchars($_POST["author"] ?? ""));
    $productData["genre"] = trim(htmlspecialchars($_POST["genre"] ?? ""));
    $productData["publicationYear"] = trim(htmlspecialchars($_POST["publicationYear"] ?? ""));

    $isValid = true;

    if (empty($productData["title"])) {
        $errors["title"] = "Title is required";
        $isValid = false;
    }
    if (empty($productData["author"])) {
        $errors["author"] = "Author is required";
        $isValid = false;
    }
    if (empty($productData["genre"])) {
        $errors["genre"] = "Genre is required";
        $isValid = false;
    }
   if (empty($productData["publicationYear"])) {
    $errors["publicationYear"] = "Publication year is required";
    $isValid = false;
    } elseif ($productData["publicationYear"] > date("Y")) {
    $errors["publicationYear"] = "Publication year cannot be in the future";
    $isValid = false;
    } elseif ($productData["publicationYear"] < 1500) {
    $errors["publicationYear"] = "Publication year must be 1500 or later";
    $isValid = false;
    }


    if ($isValid) {
        $product = new Product();
        $product->title = $productData["title"];
        $product->author = $productData["author"];
        $product->genre = $productData["genre"];
        $product->publicationYear = $productData["publicationYear"];

        if ($product->addProduct()) {
            header("Location: /project/product/viewproduct.php?success=1");
            exit;

        } else {
            echo "<p style='color:red;'>Failed to add book.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="style.css">

    <style>
    .error {
        color: red;
        font-size: 14px;
        margin: 3px 0 10px 0;
    }
    .required {
        color: red;
        font-weight: bold;
    }
</style>
    
</head>
<body>
    <h1>Add Book</h1>
    <label>Fields with <span class="required">*</span> are required</label>
    <form action="" method="post">
        <label for="title">Book Name <span class="required">*</span></label>
        <input type="text" name="title" id="title" value="<?= $productData["title"] ?? " " ?>">
        
        <p class="error"><?= $errors["title"] ?></p>

        <label for="author">Author <span class="required">*</span></label>
        <input type="text" name="author" id="author" value="<?= htmlspecialchars($productData["author"]) ?>">
        <p class="error"><?= $errors["author"] ?></p>

        <label for="genre">Genre <span class="required">*</span></label>
        <select name="genre" id="genre">
            <option value="">--SELECT--</option>
            <option value="History" <?= ($productData["genre"] == "History") ? "selected" : "" ?>>History</option>
            <option value="Science" <?= ($productData["genre"] == "Science") ? "selected" : "" ?>>Science</option>
            <option value="Fiction" <?= ($productData["genre"] == "Fiction") ? "selected" : "" ?>>Fiction</option>
        </select>
        <p class="error"><?= $errors["genre"] ?></p>

        <label for="publicationYear">Publication Year <span class="required">*</span></label>
       <input type="date" name="publicationYear" id="publicationYear"
        min="1500-01-01" max="<?= date("Y-m-d") ?>"
        value="<?= htmlspecialchars($productData["publicationYear"]) ?>">


        <p class="error"><?= $errors["publicationYear"] ?></p>
        <br>
        <input type="submit" value="Add Book">
    </form>

    <br>
    <a href="/project/product/viewproduct.php" style="padding:8px 12px; background:#007BFF; color:white; text-decoration:none; border-radius:5px;">
    Back to Book List
</a>

</body>
</html>
<?php
// //use isset to avoid undefined index notice or use double cotation mark in input value
// //value="<?= isset($productData["title"]) ? htmlspecialchars($productData["title"])
