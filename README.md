# 株式会社ライトイールド 公式Webサイト (lightyield.co.jp)

株式会社ライトイールド（Light Yield Co., Ltd.）の公式コーポレートサイトのリポジトリです。

---

## 1. サイト構成

本サイトは、静的HTMLおよびCSSで構成されたシンプルな静的ウェブサイトです。

```
.
├── README.md                      # 本ドキュメント
├── index.html                     # トップページ（会社概要・最新ブログ・アクセス）
├── CNAME                          # カスタムドメイン設定 (lightyield.co.jp)
├── favicon.ico                    # ファビコン
├── css/
│   ├── base.css                   # 全体共通ベーススタイル
│   └── blog.css                   # ブログ・ナレッジ関連スタイル
├── js/
│   └── blog.js                    # ブログ共通スクリプト（画像拡大モーダル等）
├── blog/
│   ├── index.html                 # ブログ・知見 記事一覧ページ（カテゴリ別表示）
│   ├── incorporation-wbs/         # 「株式会社を設立するWBSを作ってみた」個別記事ディレクトリ（WBSで覗いてみた）
│   │   ├── index.html             # 記事本文
│   │   └── images/                # 記事内画像
│   ├── ramen-wbs/                 # 「豚骨ラーメンを作るWBSを作ってみた」個別記事ディレクトリ（WBSで覗いてみた）
│   │   ├── index.html             # 記事本文
│   │   └── images/                # 記事内画像
│   ├── guitar-wbs/                # 「ギターを作るWBSを作ってみた」個別記事ディレクトリ（WBSで覗いてみた）
│   │   ├── index.html             # 記事本文
│   │   └── images/                # 記事内画像
│   ├── wbs-essentials/            # 「WBSの勘所」個別記事ディレクトリ（知見・コラム）
│   │   ├── index.html             # 記事本文
│   │   └── images/                # 記事内画像
│   ├── gantt-chart-leveling/      # 「ガントチャートの決め手は平準化」個別記事ディレクトリ（知見・コラム）
│   │   ├── index.html             # 記事本文
│   │   └── images/                # 記事内画像
│   └── software-estimation-accuracy/ # 「ソフトウェア開発の見積り精度を上げるには 〜中島聡氏へのQAと考察〜」個別記事ディレクトリ（知見・コラム）
│       ├── index.html             # 記事本文
│       └── images/                # 記事内画像
```

---

## 2. ローカルでの動作確認手順

静的ファイルのみで構成されているため、ローカルの簡易HTTPサーバー等で手軽にプレビュー可能です。

```bash
# Pythonを使用する場合
python3 -m http.server 8000

# または npx serve を使用する場合
npx serve .
```

ブラウザで `http://localhost:8000`（または指定ポート）を開いて確認してください。

---

## 3. ブログ記事の追加手順

新しいブログ・知見記事を追加する際は、以下の手順でファイルを配置・更新します。

1. **記事フォルダの作成**:
   `blog/<article-slug>/` ディレクトリを作成します（例: `blog/gantt-chart-leveling/`）。
2. **画像・HTMLファイルの作成**:
   - `blog/<article-slug>/images/` に記事内で使用する画像を配置（命名規則: `<slug>_fig1_xxx.jpg` 等のプレフィックス推奨）。
   - `blog/<article-slug>/index.html` を作成（既存の `blog/wbs-essentials/index.html` をテンプレートとして活用）。
3. **ブログ一覧・トップページへの追加**:
   - `blog/index.html` の `.blog_grid` 内に新しい記事カードを追加。
   - 必要に応じて `index.html` の `.blog_grid` 内の最新記事表示を更新。
