docker exec -it web_container bash

## PostgreSQL
postgres: PostgreSQLの実行ファイルを指定しています。このコマンドを実行することでPostgreSQLサーバーが起動します。
-c log_destination=stderr: ログの出力先を標準エラー出力（stderr）に設定しています。これにより、PostgreSQLのログがコンテナの標準エラー出力に出力されるようになります。
-c log_statement=all: 実行されたSQLステートメントをログに記録する設定です。all はすべてのSQLステートメントをログに記録することを意味します。
-c log_connections=on: データベースへの接続をログに記録する設定です。on は接続のログ記録を有効にすることを意味します。
-c log_disconnections=on: データベースからの切断をログに記録する設定です。on は切断のログ記録を有効にすることを意味します。
