\c pgsql;
-- テーブル作成
DROP TABLE IF EXISTS sample;
CREATE TABLE sample (
	id integer NOT NULL PRIMARY KEY,
	name char(100) NOT NULL,
	created_date_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);