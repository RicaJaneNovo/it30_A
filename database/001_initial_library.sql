/* =========================================================
   TABLE #1: Students
   ========================================================= */

CREATE TABLE IF NOT EXISTS students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,

    student_first_name VARCHAR(50) NOT NULL,
    student_last_name VARCHAR(50) NOT NULL,
    student_course VARCHAR(50) NOT NULL,

    student_created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   TABLE #2: Books
   ========================================================= */

CREATE TABLE IF NOT EXISTS books (
    -- Primary key
    book_id INT AUTO_INCREMENT PRIMARY KEY,

    -- Book details
    book_title VARCHAR(100) NOT NULL,
    book_author VARCHAR(100) NOT NULL,
    book_category VARCHAR(50) NOT NULL,

    -- Book created timestamp
    book_created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   TABLE #3: Borrows
   ========================================================= */

CREATE TABLE IF NOT EXISTS borrows (
    -- Primary key
    borrow_id INT AUTO_INCREMENT PRIMARY KEY,

    -- Foreign keys
    student_id INT NOT NULL,
    book_id INT NOT NULL,

    -- Borrow timestamp
    borrow_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    -- Return timestamp
    -- NULL means the book has not been returned yet
    borrow_return_date TIMESTAMP NULL DEFAULT NULL,

    -- Student foreign key
    CONSTRAINT fk_borrow_student
        FOREIGN KEY (student_id)
        REFERENCES students(student_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    -- Book foreign key
    CONSTRAINT fk_borrow_book
        FOREIGN KEY (book_id)
        REFERENCES books(book_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


/* =========================================================
   INSERT #1: Students
   ========================================================= */

INSERT INTO students (
    student_first_name,
    student_last_name,
    student_course
)
VALUES
    ('Rica Jane', 'Novo', 'BSIT'),
    ('Xavier', 'Alien', 'BS-HUNTER'),
    ('Zayne', 'Snowman', 'MEDICAL/Cardiologist'),
    ('Rafayel', 'Fire', 'ARTIST');


/* =========================================================
   INSERT #2: Books
   ========================================================= */

INSERT INTO books (
    book_title,
    book_author,
    book_category
)
VALUES
    ('Project Hail Mary', 'Andy Weir', 'Science Fiction'),
    ('Hell University', 'Kuya Kib', 'Mystery'),
    ('He''s Into Her', 'None so far', 'Romance');



 /* =========================================================
   INSERT #3: Borrows
   ========================================================= */

INSERT INTO borrows (
    student_id,
    book_id
)
VALUES
    (1, 2),
    (2, 1),
    (3, 3);

    --:>