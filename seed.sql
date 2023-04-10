
-- Добавление пользователей
INSERT INTO users (username, email, password, created_at,updated_at) VALUES ('user1', 'user1@example.com', 'password1', NOW(), NOW());
INSERT INTO users (username, email, password, created_at,updated_at) VALUES ('user2', 'user2@example.com', 'password2', NOW(), NOW());
INSERT INTO users (username, email, password, created_at,updated_at) VALUES ('user3', 'user3@example.com', 'password3', NOW(), NOW());


-- Добавление авторов
INSERT INTO authors (name) VALUES ('Автор 1');
INSERT INTO authors (name) VALUES ('Автор 2');
INSERT INTO authors (name) VALUES ('Автор 3');

-- Добавление жанров
INSERT INTO genres (name) VALUES ('Жанр 1');
INSERT INTO genres (name) VALUES ('Жанр 2');
INSERT INTO genres (name) VALUES ('Жанр 3');

-- Добавление книг
INSERT INTO books (title, author_id, genre_id, stock) VALUES ('Книга 1', 1, 1, 10);
INSERT INTO books (title, author_id, genre_id, stock) VALUES ('Книга 2', 2, 2, 15);
INSERT INTO books (title, author_id, genre_id, stock) VALUES ('Книга 3', 3, 3, 5);


-- Добавление связей между пользователями и книгами
INSERT INTO user_books (user_id, book_id, start_date, due_date, returned) VALUES (1, 1, '2023-04-01', '2023-05-01', FALSE);
INSERT INTO user_books (user_id, book_id, start_date, due_date, returned) VALUES (1, 2, '2023-04-15', '2023-05-15', FALSE);
INSERT INTO user_books (user_id, book_id, start_date, due_date, returned) VALUES (2, 3, '2023-04-10', '2023-04-25', TRUE);
