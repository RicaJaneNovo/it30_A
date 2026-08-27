C:\dev\IT30A\backups

C:\dev\IT30A\backups

1. CREATE DATABASE <database_name>;
2. SHOW DATABASES;
3. CONNECT TABLE <table_name_in_plural> ();
4. CREATE TABLE <table_in_plural>

        (columns)
        VALUES(values);

Utility Commands
\! cls 

mysqldump -u root -p --database library_db > C:\dev\IT30A\backups\08182026_library.sql

mysqldump -u root -p --databases library_db > "C:\dev\IT30A\backups\%date:~4%_%date:~4,2%_%date:~7,2%_%time:~0,2%_%time:~3,2%_%time:~6,2%_libray.sql"
mysqldump -u root -p --databases library_db > "C:\dev\IT30A\backups\library_%date:~10,4%-%date:~4,2%-%date:~7,2%_%time:~0,2%-%time:~3,2%-%time:~6,2%.sql"



%date:~-4%_
%date:~4,2%_
%date:~7,2%_
%time:~0,2%_
%time:~3,2%_
%time:~6,2%_
library_db.sql"

Laboratory 2

ALTER TABLE students ADD COLUMN student_created_at TIMESTAMP NULL DEFAULT NULL;
UPDATE students SET student_created_at = CURRENT_TIMESTAMP WHERE student_created_at IS NULL;
ALTER TABLE students MODIFY COLUMN  student_created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

