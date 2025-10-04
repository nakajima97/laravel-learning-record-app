# データベース設計書

## 1. ER図（テキスト表現）

```
users (1) ----< (N) main_categories (1) ----< (N) sub_categories
  |                                                      |
  |                                                      |
  +----------------------< (N) study_records (N) >------+
```

## 2. テーブル定義

### 2.1 users テーブル

ユーザー情報を管理するテーブル

| カラム名 | データ型 | NULL | キー | デフォルト | 説明 |
|---------|---------|------|------|-----------|------|
| id | BIGINT UNSIGNED | NO | PK | AUTO_INCREMENT | ユーザーID |
| name | VARCHAR(255) | NO | | | ユーザー名 |
| email | VARCHAR(255) | NO | UNIQUE | | メールアドレス |
| email_verified_at | TIMESTAMP | YES | | NULL | メール認証日時 |
| password | VARCHAR(255) | NO | | | パスワード（ハッシュ化） |
| remember_token | VARCHAR(100) | YES | | NULL | ログイン状態保持用トークン |
| created_at | TIMESTAMP | YES | | NULL | 作成日時 |
| updated_at | TIMESTAMP | YES | | NULL | 更新日時 |

**インデックス**
- PRIMARY KEY: id
- UNIQUE KEY: email

### 2.2 main_categories テーブル

メインカテゴリ情報を管理するテーブル

| カラム名 | データ型 | NULL | キー | デフォルト | 説明 |
|---------|---------|------|------|-----------|------|
| id | BIGINT UNSIGNED | NO | PK | AUTO_INCREMENT | メインカテゴリID |
| name | VARCHAR(255) | NO | | | カテゴリ名 |
| user_id | BIGINT UNSIGNED | NO | FK | | ユーザーID |
| created_at | TIMESTAMP | YES | | NULL | 作成日時 |
| updated_at | TIMESTAMP | YES | | NULL | 更新日時 |

**インデックス**
- PRIMARY KEY: id
- FOREIGN KEY: user_id → users.id

**リレーション**
- users テーブルとの関係: N:1 (多対一)
  - 1人のユーザーは複数のメインカテゴリを持つことができる
  - 1つのメインカテゴリは1人のユーザーに属する

### 2.3 sub_categories テーブル

サブカテゴリ情報を管理するテーブル

| カラム名 | データ型 | NULL | キー | デフォルト | 説明 |
|---------|---------|------|------|-----------|------|
| id | BIGINT UNSIGNED | NO | PK | AUTO_INCREMENT | サブカテゴリID |
| name | VARCHAR(255) | NO | | | サブカテゴリ名 |
| main_category_id | BIGINT UNSIGNED | NO | FK | | メインカテゴリID |
| created_at | TIMESTAMP | YES | | NULL | 作成日時 |
| updated_at | TIMESTAMP | YES | | NULL | 更新日時 |

**インデックス**
- PRIMARY KEY: id
- FOREIGN KEY: main_category_id → main_categories.id

**リレーション**
- main_categories テーブルとの関係: N:1 (多対一)
  - 1つのメインカテゴリは複数のサブカテゴリを持つことができる
  - 1つのサブカテゴリは1つのメインカテゴリに属する

### 2.4 study_records テーブル

学習記録を管理するテーブル

| カラム名 | データ型 | NULL | キー | デフォルト | 説明 |
|---------|---------|------|------|-----------|------|
| id | BIGINT UNSIGNED | NO | PK | AUTO_INCREMENT | 学習記録ID |
| minute | INTEGER | NO | | | 学習時間（分） |
| memo | VARCHAR(256) | NO | | | メモ |
| sub_category_id | BIGINT UNSIGNED | NO | FK | | サブカテゴリID |
| user_id | BIGINT UNSIGNED | NO | FK | | ユーザーID |
| created_at | TIMESTAMP | YES | | NULL | 作成日時（記録日時） |
| updated_at | TIMESTAMP | YES | | NULL | 更新日時 |

**インデックス**
- PRIMARY KEY: id
- FOREIGN KEY: sub_category_id → sub_categories.id
- FOREIGN KEY: user_id → users.id

**リレーション**
- users テーブルとの関係: N:1 (多対一)
  - 1人のユーザーは複数の学習記録を持つことができる
  - 1つの学習記録は1人のユーザーに属する
- sub_categories テーブルとの関係: N:1 (多対一)
  - 1つのサブカテゴリは複数の学習記録を持つことができる
  - 1つの学習記録は1つのサブカテゴリに属する

### 2.5 その他のテーブル

以下のテーブルはLaravelの標準機能で使用されますが、アプリケーションの主要機能には直接関係しません。

#### password_resets
- パスワードリセット用の一時トークンを保存

#### failed_jobs
- 失敗したジョブキューの記録

#### personal_access_tokens
- API認証用のトークン管理（未使用の可能性）

## 3. データモデルの特徴

### 3.1 階層構造

カテゴリは2階層の構造を持つ：
1. メインカテゴリ（例：プログラミング、語学、資格勉強）
2. サブカテゴリ（例：Laravel、PHP、JavaScript）

### 3.2 マルチテナント設計

- 各ユーザーのデータは完全に分離されている
- メインカテゴリはuser_idで所有者を識別
- 学習記録もuser_idで所有者を識別
- サブカテゴリは直接user_idを持たないが、main_category_idを経由してユーザーに紐づく

### 3.3 集計の考慮

- 学習記録のcreated_atカラムを使用して日別・月別の集計が可能
- minuteカラムの合計で学習時間の集計が可能

## 4. 推奨される追加インデックス

現在のマイグレーションファイルには外部キー制約が明示的に定義されていませんが、パフォーマンス向上のため以下のインデックスを追加することを推奨：

```sql
-- main_categories テーブル
CREATE INDEX idx_main_categories_user_id ON main_categories(user_id);

-- sub_categories テーブル
CREATE INDEX idx_sub_categories_main_category_id ON sub_categories(main_category_id);

-- study_records テーブル
CREATE INDEX idx_study_records_user_id ON study_records(user_id);
CREATE INDEX idx_study_records_sub_category_id ON study_records(sub_category_id);
CREATE INDEX idx_study_records_created_at ON study_records(created_at);
-- 日別・月別集計用の複合インデックス
CREATE INDEX idx_study_records_user_created ON study_records(user_id, created_at);
```

## 5. データ整合性の考慮事項

### 5.1 外部キー制約

マイグレーションファイルでは外部キー制約が明示的に定義されていないため、以下の点に注意が必要：

- **カスケード削除**：ユーザーやカテゴリを削除する際の関連データの扱い
- **参照整合性**：存在しないuser_idやcategory_idが登録されないようアプリケーション側で制御

### 5.2 推奨される外部キー制約

```sql
-- main_categories テーブル
ALTER TABLE main_categories
  ADD CONSTRAINT fk_main_categories_user_id
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;

-- sub_categories テーブル
ALTER TABLE sub_categories
  ADD CONSTRAINT fk_sub_categories_main_category_id
  FOREIGN KEY (main_category_id) REFERENCES main_categories(id) ON DELETE CASCADE;

-- study_records テーブル
ALTER TABLE study_records
  ADD CONSTRAINT fk_study_records_user_id
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;

ALTER TABLE study_records
  ADD CONSTRAINT fk_study_records_sub_category_id
  FOREIGN KEY (sub_category_id) REFERENCES sub_categories(id) ON DELETE RESTRICT;
```

## 6. 容量見積もりの考慮

### 6.1 テーブル別の想定レコード数（1ユーザーあたり）

- **users**: 1レコード
- **main_categories**: 5〜20レコード程度
- **sub_categories**: 10〜50レコード程度
- **study_records**: 日次で増加、年間365〜1,000レコード程度

### 6.2 長期運用における考慮事項

- study_recordsテーブルは継続的に増加するため、定期的なアーカイブやパーティショニングを検討する必要がある
- created_atによる時系列検索が頻繁に行われるため、適切なインデックス設計が重要
