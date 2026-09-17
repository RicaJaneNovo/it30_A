<?php
//Database Connection
$host = 'localhost';
$db = 'it30a_lab_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host; dnmae=$db; charset=$charset";

$option = [
    PDO::ATTR_ERRMODE =>PDO::ERMODE_EXCEPTION,
    PDO:: ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC,
    PDO:: ATTR_EMULATE_PREPARES =>false,
];

try{
    $pdo = new PDO ($dsn,$user,$pass,$options);
    echo 'Database connection successful';
} catch (PDOException $e) {
    die("Database connection failed" . $e->getMessage());
}

//Session'
session_start();

//Determin current section
$section = $_GET['section'] ?? 'students';

//CRUD Operations
$actions = $_GET['action'] ?? '';


//-----------------------------------------------------------
//Students
//-----------------------------------------------------------

//-----------------------------------------------------------
//Fetch Students
if($section === 'students') {
    $stmt = $pdo ->query("
    SELECT *
    FROM students
    ORDER by student_id DESC
    ");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
</head>
<body>
    <h1> Simple Library System</h1>
    <nav>
        <a href="index.php?section=students">Students</a>
        <a href="index.php?section=books">Books</a>
        <a href="index.php?section=borrow">Borrows
</nav>
        <hr>
        <?php if ($section === 'students') : ?>
            <h1>Students</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Course</th>
                    <th>Created At</th>
                    <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($students as $student): ?>
                

        <?php if ($section === 'books') : ?>
            <h1>Books</h1>
        <?php endif; ?>

        <?php if ($section === 'borrows') : ?>
            <h1>Borrows</h1>
        <?php endif; ?>
</body>
</html>