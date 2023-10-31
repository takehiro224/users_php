# 概要
データの一覧表示・登録・更新・削除のサンプルプログラムを作成

## 詳細
- DBからデータを取得して表示する
- DBへデータの削除を行う
- DBへ新規データ登録を行う
- DBのデータを更新する
- ログインを行う
- セッション管理を行う
- パスワードはハッシュ管理する(password_hash関数)
- バリデーションチェックを行う

## Webアプリ作成リスト

|No.|対象| フロントエンド   | バックエンド | DB    | その他(FWなど) |
|:-:| :---: | ------ | ---- | ------- | ------- |
|1|○| PHP  | PHP   | PostgreSQL ||
|2|| PHP(Blade) | PHP | PostgreSQL | Laravel |
|3|| PHP | PHP | PostgreSQL | CakePHP |
|4|| JavaScript  | PHP | MySQL | ReactJS, Laravel |
|5|| JavaScript  | Golang | MySQL | ReactJS |
|6|| TypeScript  | Golang | MySQL | ReactJS |
|7|| TypeScript  | Java | MySQL | ReactJS |
|8|| TypeScript  | Ruby | MySQL | ReactJS |
|9|| TypeScript  | Python | MySQL | ReactJS |

## その他技術要素
- テストコード作成
- Swagger作成
- Docker利用
- Kubernetes利用
- Terraform利用
- AWS上へ展開



admin / admin_pass
root / root_pass
docker exec -it web_container bash