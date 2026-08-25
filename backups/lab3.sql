CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    book_title VARCHAR (50) NOT NULL,
    book_author VARCHAR(50) NOT NULL,
    book_category VARCHAR(50) NOT NULL,
    book_created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO books (book_title,book_author,book_category) VALUES ("Project Hail Mary", "Andy Weir", "Science Fiction"); ("Hell University", "Kuya Kib", "Mystery"); ("He's Into Her", "None so far", "romance");