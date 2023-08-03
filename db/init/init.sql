-- 下記の「\c データベース名」が書かれていないと実行されない
\c postgres;
-- usersテーブルを作成するクエリ
CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- usersテーブルに初期データを挿入するクエリ
INSERT INTO users (name, email, password)
VALUES
  ('John Doe', 'john@example.com', 'password123'),
  ('Jane Smith', 'jane@example.com', 'secret123'),
  ('Bob Johnson', 'bob@example.com', '123456');





