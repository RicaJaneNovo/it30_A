-- Prevent two active borrows for the same student or book.
-- Each active foreign key value is stored in a generated column; NULL for returned records.

ALTER TABLE borrows
    ADD COLUMN active_student_id INT
        GENERATED ALWAYS AS (
            CASE WHEN borrow_return_date IS NULL THEN student_id ELSE NULL END
        ) STORED,
    ADD COLUMN active_book_id INT
        GENERATED ALWAYS AS (
            CASE WHEN borrow_return_date IS NULL THEN book_id ELSE NULL END
        ) STORED,
    ADD UNIQUE KEY uq_borrows_active_student (active_student_id),
    ADD UNIQUE KEY uq_borrows_active_book (active_book_id);
