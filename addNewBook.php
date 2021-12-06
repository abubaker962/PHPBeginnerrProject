<?php
include('includes/header.php');
include('includes/dbConnection.php');
if (isset($_POST['submit'])) {
    $formData = array();
    $errorImage = '';
    $formData['bookName'] = $_POST['bookName'];
    $formData['publisherName'] = $_POST['publisherName'];
    $formData['bookIsbnNumber'] = $_POST['bookIsbnNumber'];
    $fileType = $_FILES['bookCoverImage']['type'];
    if ($fileType != 'image/jpeg' || $fileType == '') {
        $imageError = '*Please upload image in JGP/JPEG Format*';
    } else {
        $coverImageName = $_FILES['bookCoverImage']['name'];
        $coverImageTempName = $_FILES['bookCoverImage']['tmp_name'];
        $path = 'coverImages/' . $coverImageName;
        move_uploaded_file($coverImageTempName, $path);
        $insertQuery = "INSERT INTO phpProject.books (bookName, publisherName, isbnNumber, coverImage) 
        VALUES ('{$formData['bookName']}', '{$formData['publisherName']}', '{$formData['bookIsbnNumber']}', '$coverImageName')";
        $conn->query($insertQuery);
        $conn->close();
        $formData = null;
        header("Location: http://localhost/PHPBeginnerProject/");
        die();
    }
}
$conn->close();
?>
<div class="container" id="bookFormDiv">
    <h2>Add New Book</h2>
    <form name="addBookForm" action="addNewBook.php" method="post" enctype="multipart/form-data">
        <input type="text" id="bookName" name="bookName" placeholder="Enter Book Name" value="<?php echo htmlspecialchars(@$formData['bookName']) ?>" required>
        <br>
        <input type="text" id="publisherName" name="publisherName" placeholder="Enter Publisher Name" 
        value="<?php echo htmlspecialchars(@$formData['publisherName']) ?>" required>
        <br>
        <input type="number" id="bookIsbnNumber" name="bookIsbnNumber" maxlength="13" onkeypress="return checkPositiveInteger(event)" 
        placeholder="Enter ISBN Number" value="<?php echo htmlspecialchars(@$formData['bookIsbnNumber']) ?>" required>
        <br>
        <label class="file">Upload book cover image:</label>
        <br>
        <input class="file" type="file" id="bookCoverImage" name="bookCoverImage">
        <span class="error"><?php echo htmlspecialchars(@$imageError) ?></span>
        <br><br>
        <input class="button" type="submit" id="submit" name="submit">
        <br>
    </form>
</div>
</body>

</html>