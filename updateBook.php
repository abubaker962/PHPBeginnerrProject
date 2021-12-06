<?php
include('includes/dbConnection.php');
include('includes/header.php');

if (isset($_GET['id'])) {
    $sql = "select * from phpProject.books WHERE id={$_GET['id']}";
    $queryResult = $conn->query($sql);
    $record = $queryResult->fetch_assoc();
    $formData = setFormData($record);
}

if (isset($_POST['submit'])) {
    $formData = setFormData($_POST);
    $fileType = $_FILES['bookCoverImage']['type'];
    if ($fileType != 'image/jpeg' && $fileType != null) {
        $imageError = '*Please upload image in JGP/JPEG Format*';
    } else {
        if ($fileType != null) {
            $coverImageName = $_FILES['bookCoverImage']['name'];
            $coverImageTempName = $_FILES['bookCoverImage']['tmp_name'];
            $path = 'coverImages/' . $coverImageName;
            move_uploaded_file($coverImageTempName, $path);
            $updateQuery = "UPDATE phpProject.books SET bookName = '{$formData['bookName']}', publisherName = '{$formData['publisherName']}',
            isbnNumber = '{$formData['isbnNumber']}', coverImage = '{$coverImageName}' where id = {$formData['id']}";
        } else {
            $updateQuery = "UPDATE phpProject.books SET bookName = '{$formData['bookName']}', publisherName = '{$formData['publisherName']}',
            isbnNumber = '{$formData['isbnNumber']}' where id = {$formData['id']}";
        }
        $conn->query($updateQuery);
        $conn->close();
        header("Location: http://localhost/PHPBeginnerProject/");
        die();
    }
}
function setFormData($record)
{
    $formData = array();
    $formData['id'] = $record['id'];
    $formData['bookName'] = $record['bookName'];
    $formData['publisherName'] = $record['publisherName'];
    $formData['isbnNumber'] = $record['isbnNumber'];
    $formData['coverImage'] = $record['coverImage'];
    return $formData;
}
?>

<div class="container" id="bookFormDiv">
    <h2>Update Book Information</h2>
    <form name="updateBookForm" action="updateBook.php" method="post" enctype="multipart/form-data">
        <input type="number" id="id" name="id" value="<?php echo htmlspecialchars(@$formData['id']) ?>" hidden>
        <input type="text" id="bookName" name="bookName" placeholder="Enter Book Name" value="<?php echo htmlspecialchars(@$formData['bookName']) ?>" required>
        <br>
        <input type="text" id="publisherName" name="publisherName" placeholder="Enter Publisher Name" value="<?php echo htmlspecialchars(@$formData['publisherName']) ?>" required>
        <br>
        <input type="number" id="bookIsbnNumber" name="isbnNumber" maxlength="13" onkeypress="return checkPositiveInteger(event)" 
        placeholder="Enter ISBN Number" value="<?php echo htmlspecialchars(@$formData['isbnNumber']) ?>" required>
        <br>
        <label class="file">Upload book cover image:</label>
        <br>
        <input class="file" type="file" id="bookCoverImage" name="bookCoverImage">
        <span class="error"><?php echo htmlspecialchars(@$imageError) ?></span>
        <br>
        <img width="50px" height="50px" src="coverImages/<?php echo $formData['coverImage'] ?>">
        <br><br>
        <input class="button" type="submit" id="submit" name="submit">
        <br>
    </form>
</div>

</body>

</html>