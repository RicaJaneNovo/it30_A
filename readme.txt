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

mysqldump -u root -p --database library_db > C:\Users\Administrator\backups\08182026_library.sql

mysqldump -u root -p --databases library_db < C:Users\Administrator\backups\%date:~-4%_%date:~-4%_%date