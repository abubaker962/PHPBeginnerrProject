<?php
include('includes/header.php');
include('includes/dbConnection.php');

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

if (isset($_POST['submit'])) {
    $searchToken = "WHERE MATCH(bookName, publisherName, isbnNumber) AGAINST('{$_POST['searchBox']}')";
} else {
    $searchToken = "";
}

$recordsPerPage = 10;
$start = ($page - 1) * 10;

$getRowsQuery = "select * from phpProject.books " . $searchToken . " limit $start, $recordsPerPage";
$result = $conn->query($getRowsQuery);
?>

<div class="container">
    <div id="searchBoxDiv">
        <form name="searchBookForm" action="index.php" method="post">
            <input type="text" id="searchBox" name="searchBox" placeholder="Enter Keyword to Search...">
            <input class="button" type="submit" id="submit" name="submit" value="Search">
        </form>
    </div>
    <div id="addNewBookButtonDiv">
        <a href="addNewBook.php"><button id="addNewBookButton">Add New Book</button></a>
    </div>
    <table id="booksTable">
        <tr>
            <th>Book Name</th>
            <th>Publisher Number </th>
            <th>ISBN Number</th>
            <th colspan="2">Operations</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row['bookName']; ?></td>
                <td><?php echo $row['publisherName']; ?></td>
                <td><?php echo $row['isbnNumber']; ?></td>
                <td><a href="updateBook.php?id=<?php echo $row['id'] ?>"><button id="updateButton">Update</button></a></td>
                <td><a href="deleteBook.php?id=<?php echo $row['id'] ?>"><button id="deleteButton">Delete</button></a></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

<?php

$getAllRowsQuery = "select * from phpProject.books " . $searchToken;
$allRowsResult = $conn->query($getAllRowsQuery);
$totalRows = $allRowsResult->num_rows;
$totalPages = ceil($totalRows / $recordsPerPage);
if ($totalPages > 1) {
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a class='button' href='index.php?page=" . $i . "'>" . $i . "</a>";
    }
}
$conn->close();
?>

</body>

</html>