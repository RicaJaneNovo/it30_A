<?php
//Database Connection
$host = 'localhost';
$db = 'it30a_lab_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
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
$action = $_GET['action'] ?? '';


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
    $students = $stmt->fetchAll();
}

//Create Student
if($section==='students' && $action==='create') {
     if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName =trim($_POST['student_first_name'] ?? '');
        $lastName =trim($_POST['student_last_name'] ?? '');
        $course =trim($_POST['student_course'] ?? '');
        if ($firstName !== '' && $lastName !== '' && $course !== '') {
            $sql=("
              INSERT INTO students (
              student_first_name,
              student_last_name,
              student_course
              )
              VALUES (?,?,?)
            ");

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $firstName,
                $lastName,
                $course
            ]);
            //$_SESSION['alert'] = 'Student Saved Successfully';

            header("Location: index.php?section=students");
            exit;
        }
     }
}  

//Update Student
if($section==='students'&& $action==='update') {
    $studentId = (int) ($_GET['id'] ?? 0);


    //Retrieve Student Information
    $stmt = $pdo->prepare("
        SELECT * 
        FROM students
        WHERE student_id =?
    ");

    $stmt->execute([$studentId]);

    $student = $stmt->fetch();





    // Update Student Info

    if($section==='students' && $action==='update') {
     if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstName =trim($_POST['student_first_name'] ?? '');
        $lastName =trim($_POST['student_last_name'] ?? '');
        $course =trim($_POST['student_course'] ?? '');
        if ($firstName !== '' && $lastName !== '' && $course !== '') {
            $sql=("
              UPDATE students 
              SET

                      student_first_name =?,
                      student_last_name =?,
                      student_course =?
                WHERE student_id=?
            ");

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $firstName,
                $lastName,
                $course,
                $studentId
            ]);
            
            $_SESSION['alert'] = 'Student Updated Successfully';

            header("Location: index.php?section=students");
            exit;
        }
     }
}  
}


//-----------------------------------------------------------
//Books
//-----------------------------------------------------------

//-----------------------------------------------------------
//Fetch Books
if($section === 'books') {
    $stmt = $pdo->query("
        SELECT *
        FROM books
        ORDER BY book_id DESC
    ");

    $books = $stmt->fetchAll();
}


//Create Book
if($section==='books' && $action==='create') {
     if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $bookTitle =trim($_POST['book_title'] ?? '');
        $bookAuthor =trim($_POST['book_author'] ?? '');
        $bookCategory =trim($_POST['book_category'] ?? '');
        if ($bookTitle !== '' && $bookAuthor !== '' && $bookCategory !== '') {
            $sql=("
              INSERT INTO books (
              book_title,
              book_author,
              book_category
              )
              VALUES (?,?,?)
            ");

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $bookTitle,
                $bookAuthor,
                $bookCategory
            ]);
            //$_SESSION['alert'] = 'Student Saved Successfully';

            header("Location: index.php?section=books");
            exit;
        }
     }
}  

//Update Book
if($section==='books'&& $action==='update') {
    $bookId = (int) ($_GET['id'] ?? 0);


    //Retrieve Book Information
    $stmt = $pdo->prepare("
        SELECT * 
        FROM books
        WHERE book_id =?
    ");

    $stmt->execute([$bookId]);

    $book = $stmt->fetch();





    // Update Book Info

    if($section==='books' && $action==='update') {
     if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $bookTitle =trim($_POST['book_title'] ?? '');
        $bookAuthor =trim($_POST['book_author'] ?? '');
        $bookCategory =trim($_POST['book_category'] ?? '');
        if ($bookTitle !== '' && $bookAuthor !== '' && $bookCategory !== '') {
            $sql=("
              UPDATE books 
              SET

                      book_title =?,
                      book_author =?,
                      book_category =?
                WHERE book_id=?
            ");

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $bookTitle,
                $bookAuthor,
                $bookCategory,
                $bookId
            ]);
            
            $_SESSION['alert'] = 'Book Updated Successfully';

            header("Location: index.php?section=books");
            exit;
        }
     }
}  
}


//-----------------------------------------------------------
//Borrows
//-----------------------------------------------------------

//-----------------------------------------------------------
//Fetch Borrows
if($section === 'borrows') {
    $stmt = $pdo->query("
        SELECT *
        FROM borrows
        ORDER BY borrow_id DESC
    ");

    $borrows = $stmt->fetchAll();
}


//Create Borrow
if($section === 'borrows' && $action === 'create') {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $borrowId = trim($_POST['borrow_id'] ?? '');
        $studentId = trim($_POST['student_id'] ?? '');
        $bookId = trim($_POST['book_id'] ?? '');
        $borrowDate = trim($_POST['borrow_date'] ?? '');

        if ($borrowId !== '' && $studentId !== '' && $bookId !== '' && $borrowDate !== '') {
            $sql = ("
                INSERT INTO borrows (
                    borrow_id,
                    student_id,
                    book_id,
                    borrow_date
                )
                VALUES (?,?,?,?)
            ");

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $borrowId,
                $studentId,
                $bookId,
                $borrowDate
            ]);

            //$_SESSION['alert'] = 'Borrow Saved Successfully';

            header("Location: index.php?section=borrows");
            exit;
        }
    }
}


//Update Borrow
if($section === 'borrows' && $action === 'update') {
    $borrowId = (int) ($_GET['id'] ?? 0);

    //Retrieve Borrow Information
    $stmt = $pdo->prepare("
        SELECT *
        FROM borrows
        WHERE borrow_id = ?
    ");

    $stmt->execute([$borrowId]);

    $borrow = $stmt->fetch();


    //Update Borrow Info
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $borrowId = trim($_POST['borrow_id'] ?? '');
        $studentId = trim($_POST['student_id'] ?? '');
        $bookId = trim($_POST['book_id'] ?? '');
        $borrowDate = trim($_POST['borrow_date'] ?? '');

        if ($borrowId !== '' && $studentId !== '' && $bookId !== '' && $borrowDate !== '') {
            $sql = ("
                UPDATE borrows
                SET
                    borrow_id = ?,
                    student_id = ?,
                    book_id = ?,
                    borrow_date = ?
                WHERE borrow_id = ?
            ");

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $borrowId,
                $studentId,
                $bookId,
                $borrowDate,
                $borrowId
            ]);

            $_SESSION['alert'] = 'Borrow Updated Successfully';

            header("Location: index.php?section=borrows");
            exit;
        }
    }
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
        <a href="index.php?section=borrows">Borrows</a>
</nav>
        <hr>
        <?php if ($section === 'students') : ?>
            <h1>Students</h1>
            <p>
                <a href="index.php?section=students&action=create">
                     Add New Student
            </a>
        </p>

        <?php if($action==='create'): ?>

            <h2>Add New Student </h2>

                <form method="POST">
                        <p>
                            <label>First Name</label>
                        <br>
                        <input type="text"
                             name="student_first_name"
            value=""
            required
            />        
    </p>

    <p> 
        <label>Last Name</label>
        <br>
        <input type="text"
            name="student_last_name"
            value=""
            required
            />   
    </p>

    <p> 
        <label>Course</label>
        <br>
        <input type="text"
            name="student_course"
            value=""
            required
            />   
    </p>

    <button type="submit">
        Save
    </button>

    <a href="index.php?section=students">
        Cancel
    </a>
</form>


<?php elseif($action==='update'): ?>

            <h2>Update Student </h2>

                <form method="POST">
                        <p>
                            <label>First Name</label>
                        <br>
                        <input type="text"
                             name="student_first_name"
            value=""
            required
            />        
    </p>

    <p> 
        <label>Last Name</label>
        <br>
        <input type="text"
            name="student_last_name"
            value=""
            required
            />   
    </p>

    <p> 
        <label>Course</label>
        <br>
        <input type="text"
            name="student_course"
            value=""
            required
            />   
    </p>

    <button type="submit">
        Update
    </button>

    <a href="index.php?section=students">
        Cancel
    </a>
</form>


                    <?php else: ?>
                    <table border ="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Course</th>
                    <th>Created At</th>
                    <th>Actions</th>
        </tr>
        <tbody> 
            <?php foreach($students as $student): ?> 
                <tr> 
                    <td> 
                        <?= htmlspecialchars($student['student_id']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($student['student_first_name']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($student['student_last_name']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($student['student_course']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($student['student_created_at']) ?> 
            </td> 
            <td> 
                <a href= "index.php?section=students&action=update&id=<?=$student['student_id'] ?>">Edit</a> 
                |
                <a>Delete</a> 
            </td> 
            </tr> 
            <?php endforeach; ?>
            </tbody> 
            </table> 
            <?php endif; ?>


<?php endif; ?> 









        <?php if ($section === 'books') : ?>
            <h1>Books</h1>


             <p>
                <a href="index.php?section=books&action=create">
                    Add New Book
                </a>
        </p>

        <?php if($action==='create'): ?>

            <h2>Add New Book </h2>

                <form method="POST">
                        <p>
                            <label>Book Title</label>
                        <br>
                        <input type="text"
                             name="book_title"
            value=""
            required
            />        
    </p>

    <p> 
        <label>Book Author</label>
        <br>
        <input type="text"
            name="book_author"
            value=""
            required
            />   
    </p>

    <p> 
        <label>Book Category</label>
        <br>
        <input type="text"
            name="book_category"
            value=""
            required
            />   
    </p>

    <button type="submit">
        Save
    </button>

    <a href="index.php?section=students">
        Cancel
    </a>
</form>


<?php elseif($action==='update'): ?>

            <h2>Update Book </h2>

                <form method="POST">
                        <p>
                            <label>Book Title</label>
                        <br>
                        <input type="text"
                             name="book_title"
            value="<?= htmlspecialchars($book['book_title']) ?>"
            required
            />        
    </p>

    <p> 
        <label>Book Author</label>
        <br>
        <input type="text"
            name="book_author"
            value="<?= htmlspecialchars($book['book_author']) ?>"
            required
            />   
    </p>

    <p> 
        <label>Book Category</label>
        <br>
        <input type="text"
            name="book_category"
            value="<?= htmlspecialchars($book['book_category']) ?>"
            required
            />   
    </p>

    <button type="submit">
        Update
    </button>

    <a href="index.php?section=students">
        Cancel
    </a>
</form>





                    <?php else: ?>
                    <table border ="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Title</th>
                    <th>Book Author</th>
                    <th>Book Category</th>
                    <th>Created At</th>
                    <th>Actions</th>
        </tr>
        <tbody> 
            <?php foreach($books as $book): ?> 
                <tr> 
                    <td> 
                        <?= htmlspecialchars($book['book_id']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($book['book_title']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($book['book_author']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($book['book_category']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($book['book_created_at']) ?> 
            </td> 
            <td> 
                <a href= "index.php?section=books&action=update&id=<?=$book['book_id'] ?>">Edit</a> 
                |
                <a>Delete</a> 
            </td> 
            </tr> 
            <?php endforeach; ?>
            </tbody> 
            </table> 
            <?php endif; ?>
            <?php endif; ?>







        <?php if ($section === 'borrows') : ?> 
            <h1>Borrows</h1> 

            <p>
                <a href="index.php?section=borrows&action=create">
                     Add New Borrow Book
            </a>
        </p>

        <?php if($action==='create'): ?>

            <h2>Add New Borrow Book </h2>

                <form method="POST">
                        <p>
                            <label>Borrow Id</label>
                        <br>
                        <input type="text"
                             name="borrow_id"
            value=""
            required
            />        
    </p>

    <p> 
        <label>Student Id</label>
        <br>
        <input type="text"
            name="student_id"
            value=""
            required
            />   
    </p>

    <p> 
        <label>Book Id</label>
        <br>
        <input type="text"
            name="book_id"
            value=""
            required
            />   
    </p>

    <p> 
        <label>Borrow Date</label>
        <br>
        <input type="text"
            name="borrow_date"
            value=""
            required
            />   
    </p>

    <button type="submit">
        Save
    </button>

    <a href="index.php?section=borrows">
        Cancel
    </a>
</form>


<?php elseif($action==='update'): ?>

                <form method="POST">
                        <p>
                            <label>Borrow Id</label>
                        <br>
                        <input type="text"
                             name="borrow_id"
            value="<?= htmlspecialchars($borrow['borrow_id']) ?>"
            required
            />        
    </p>

    <p> 
        <label>Student Id</label>
        <br>
        <input type="text"
            name="student_id"
            value="<?= htmlspecialchars($borrow['student_id']) ?>"
            required
            />   
    </p>

    <p> 
        <label>Book Id</label>
        <br>
        <input type="text"
            name="book_id"
            value="<?= htmlspecialchars($borrow['book_id']) ?>"
            required
            />   
    </p>

    <p> 
        <label>Borrow Date</label>
        <br>
        <input type="text"
            name="borrow_date"
            value="<?= htmlspecialchars($borrow['borrow_date']) ?>"
            required
            />   
    </p>

    <p> 
        <label>Return Date</label>
        <br>
        <input type="text"
            name="borrow_return_date"
            value="<?= htmlspecialchars($borrow['borrow_return_date']) ?>"
            />   
    </p>

    <button type="submit">
        Update
    </button>

    <a href="index.php?section=borrows">
        Cancel
    </a>
</form>
           


                    <?php else: ?>
                    <table border ="1">
            <thead>
                <tr>
                    <th>Borrow Id</th>
                    <th>Student Id</th>
                    <th>Book Id</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Actions</th>
        </tr>
        </thead>
        <tbody> 
            <?php foreach($borrows as $borrow): ?> 
                <tr> 
                    <td> 
                        <?= htmlspecialchars($borrow['borrow_id']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($borrow['student_id']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($borrow['book_id']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($borrow['borrow_date']) ?> 
            </td> 
                     <td> 
                        <?= htmlspecialchars($borrow['borrow_return_date']) ?> 
            </td> 
            <td> 
                <a href="index.php?section=borrows&action=update&id=<?=$borrow['borrow_id'] ?>">Edit</a>
                |
                <a>Delete</a> 
            </td> 
            </tr> 
            <?php endforeach; ?>
            </tbody> 
            </table> 
<?php endif; ?>
<?php endif; ?>


</body>


<?php if (isset ($_SESSION['alert'])): ?>

           <script>
               alert(<?=json_encode($_SESSION['alert'])?>);
            </script>

            <?php unset($_SESSION['alert']); ?>

<?php endif; ?>


</body>
</html>