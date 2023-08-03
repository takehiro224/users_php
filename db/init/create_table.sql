-- 下記の「\c データベース名」が書かれていないと実行されない
\c postgres;
-- usersテーブルを作成するクエリ
-- CREATE TABLE users (
--   id SERIAL PRIMARY KEY,
--   name VARCHAR(255) NOT NULL,
--   email VARCHAR(255) NOT NULL,
--   password VARCHAR(255) NOT NULL
-- );

CREATE TABLE users (
    id              VARCHAR(10) NOT NULL,
    name            VARCHAR(255) NOT NULL,
    name_kana       VARCHAR(255) NOT NULL,
    birthday        DATE NOT NULL,
    gender       VARCHAR(10) NOT NULL,
    organization    VARCHAR(20) NOT NULL,
    post            VARCHAR(20) NOT NULL,
    start_date      DATE NOT NULL,
    tel             VARCHAR(20) NOT NULL,
    mail_address    VARCHAR(255) NOT NULL,
    created         TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated         TIMESTAMP,
    PRIMARY KEY(id)
);

CREATE TABLE login_accounts (
    id           SERIAL NOT NULL,
    login_id     VARCHAR(100) NOT NULL UNIQUE,
    password     VARCHAR(255) NOT NULL,
    name         VARCHAR(255) NOT NULL,
    created      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated      TIMESTAMP,
    PRIMARY KEY (id)
);