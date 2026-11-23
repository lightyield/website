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
│   ├── top.css                    # トップページ専用スタイル（キービジュアル・非対称エディトリアル構成）
│   └── blog.css                   # ブログ・ナレッジ関連スタイル
├── images/
│   └── hero-bg.jpg                # トップページ ヒーロー背景ビジュアル
├── js/
│   └── blog.js                    # ブログ共通スクリプト（画像拡大モーダル、カテゴリ切り替えタブ制御等）
├── blog/
│   ├── index.html                     # 旧URL（/blog/）からのリダイレクト用フォールバック
│   ├── peek-into-wbs/                 # 「WBSで覗いてみた」カテゴリディレクトリ
│   │   ├── index.html                 # 「WBSで覗いてみた」全記事一覧ページ（LP同レイアウト）
│   │   ├── 20261108-pmark-wbs/        # 「「プライバシーマーク（Pマーク）」を新規取得するWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20261030-yashiori-wbs/     # 「映画「シン・ゴジラ」のヤシオリ作戦を完遂するWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20261028-incorporation-2026-wbs/ # 「「株式会社を設立するWBS」を2026年版にアップデートしてみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20261025-sf2-wbs/          # 「アーケード版「ストリートファイターⅡ」をクリアするWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20261023-dq2-wbs/          # 「ファミコン版「ドラゴンクエストⅡ」をクリアするWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20261018-craft-cola-wbs/   # 「クラフトコーラを自宅で再現するWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20261017-trademark-wbs/    # 「社名・ロゴの商標登録出願を行うWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20261016-local-llm-wbs/    # 「ライトイールド向けローカルLLM環境を構築するWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20261009-kindle-wbs/       # 「WBSのすすめ 電子書籍（Kindle）を出版するWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20261004-craft-beer-wbs/   # 「オリジナルクラフトビールを委託醸造するWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20261002-camp-wbs/         # 「夏の琵琶湖ファミリーキャンプ設営のWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20260926-soba-wbs/         # 「年越し手打ち蕎麦を作るWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20181215-ramen-wbs/        # 「豚骨ラーメンを作るWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20181206-passport-wbs/     # 「パスポートを作成するWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   ├── 20181201-guitar-wbs/       # 「ギターを作るWBSを作ってみた」個別記事
│   │   │   ├── index.html
│   │   │   └── images/
│   │   └── 20181123-incorporation-wbs/# 「株式会社を設立するWBSを作ってみた」個別記事
│   │       ├── index.html
│   │       └── images/
│   └── knowledge-column/              # 「知見・コラム」カテゴリディレクトリ
│       ├── index.html                 # 「知見・コラム」全記事一覧ページ（LP同レイアウト）
│       ├── 20261122-ipa-req-mgmt-handbook/     # 「IPA「AI 時代の要求管理ハンドブック」から読み解く変化点」個別記事
│       │   ├── index.html
│       │   └── images/
│       ├── 20261122-ai-driven-development-wbs/ # 「AI駆動開発におけるWBSとガントチャートの使い所」個別記事
│       │   ├── index.html
│       │   └── images/
│       ├── 20261103-wbs-progress-reporting/     # 「WBSを用いた進捗管理の勘所」個別記事
│       │   ├── index.html
│       │   └── images/
│       ├── 20261011-yamamoto-isoroku-mentoring/ # 「山本五十六の言葉「やってみせ」」個別記事
│       │   └── index.html
│       ├── 20261010-digital-agency-wbs/        # 「デジタル庁の研修資料から見たWBSの要点」個別記事
│       │   ├── index.html
│       │   └── images/
│       ├── 20190318-software-estimation-accuracy/# 「ソフトウェア開発の見積り精度を上げるには」個別記事
│       │   ├── index.html
│       │   └── images/
│       ├── 20181119-gantt-chart-leveling/      # 「ガントチャートの決め手は平準化」個別記事
│       │   ├── index.html
│       │   └── images/
│       └── 20181118-wbs-essentials/            # 「WBSの勘所」個別記事
│           ├── index.html
│           └── images/
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
   該当カテゴリのディレクトリ配下に `YYYYMMDD-<article-slug>` 形式で作成します。
   - WBSで覗いてみた: `blog/peek-into-wbs/YYYYMMDD-<slug>/`（例: `blog/peek-into-wbs/20261009-kindle-wbs/`）
   - 知見・コラム: `blog/knowledge-column/YYYYMMDD-<slug>/`（例: `blog/knowledge-column/20261010-digital-agency-wbs/`）
2. **画像・HTMLファイルの作成**:
   - `images/` サブディレクトリに記事内で使用する画像を配置（命名規則: `<slug>_fig1_xxx.jpg` 等のプレフィックス推奨）。
   - `index.html` を作成（既存の類似記事の `index.html` をテンプレートとして活用。CSS/JSの相対パスは `../../../css/`、`../../../js/`。関連記事への誘導リンク等は冒頭ではなく末尾の「終わりに」セクションに配置）。
   - **アクセシビリティ対応**: `<body>` 直後にスキップリンク（`.skip_link`）を配置し、`<main id="main-content">` へ遷移可能とすること。パンくずリストは `<nav aria-label="現在位置">` と `<ol class="breadcrumb_list">` を用い、現在地に `aria-current="page"` を付与すること。目次は `<nav class="article_toc" aria-label="目次">` とすること。
3. **カテゴリ別一覧ページ・トップページへの追加**:
   - 該当カテゴリの一覧ページ（`blog/knowledge-column/index.html` または `blog/peek-into-wbs/index.html`）に新しい記事を追加します。最新1件を `.featured_article`、残りの全記事を `.article_list` に日付降順で掲載します（件数表記は不要）。
   - トップページ（`index.html`）の該当シリーズ（`#knowledge` / `#peek-into-wbs`）を更新します。**トップページは各シリーズとも記事の日付の直近5件（最新1件 `.featured_article` ＋ 次点4件 `.article_list`）のみを表示**します（件数表記は不要）。
4. **前後の記事ナビゲーション（`article_pager`）の更新**:
   - 追加した新記事の `index.html` 内の `.article_pager` に、同カテゴリ内の直前の過去記事へのリンク（`pager_prev`）を設定します。
   - 直前の記事（これまで最新だった記事）の `index.html` を開き、新記事へのリンク（`pager_next`）を追加・更新します。

---

## 4. デザイン仕様（トップページ構成およびヒーローセクション）

トップページ（`index.html` / `css/top.css`）は、ファーストビューでブランドの世界観を印象づけつつ、直下からブログの2大シリーズへ自然に誘導する構成を採用しています。

- **ヒーローセクション**:
  - 最適化された背景キービジュアル（`images/hero-bg.jpg`）にダークネイビーのグラデーションオーバーレイを掛け、コピーの視認性（WCAG 2.1 AA以上）と静謐なブランド表現を両立。
  - 上部ナビゲーション（`.header_nav`）から「知見・コラム」「WBSで覗いてみた」「ABOUT」へ即アクセス可能。
- **2大シリーズ強調・非対称エディトリアル構成**:
  - 記事サムネイルを排したテキスト主役の設計とし、「知見・コラム」→「WBSで覗いてみた」→「会社概要・アクセス」の順で統一された白背景上に配置。
  - 左カラムに見出し柱（`.pillar_aside`、PCではSticky追従）、右カラムに最新記事カード＋罫線リストを置くことで、閲覧中のカテゴリを常に明確化。
- **レスポンシブ対応**:
  - タブレット・スマートフォン（`@media (max-width: 960px)` / `768px`）では1カラム構成へ自然に切り替わり、ヘッダーナビゲーションにもブログ導線を保持。

---

## 5. アクセシビリティおよびデザインシステム設計指針（DADS準拠）

本サイトでは、デジタル庁デザインシステム（Digital Agency Design System: DADS）のアクセシビリティ理念（誰一人取り残されない、人に優しいデジタル化）およびデザイントークン設計、WCAG 2.1 レベルAA（JIS X 8341-3）を取り入れたコーディング規約を策定・適用しています。

### 1. デザイントークン体系 (`css/base.css`)
- `:root` にてカラー（Primary, Accent, Focus, Neutral）、タイポグラフィ、スペーシング、ボーダー角丸を集中管理。
- **コントラスト比の確保**: 本文およびリンク文字は、WCAG 2.1 AA 基準（通常テキスト 4.5:1 以上、大型テキスト 3:1 以上）を全背景色でクリアする配色（`--color-accent: #2d5a88` 等）を維持。

### 2. キーボード操作性とフォーカス表示
- **フォーカスリング（Focus Indicator）**: `:focus-visible` を用いて、キーボード操作時に視認性の高い二重線・アウトライン（`--color-focus: #005bac`）を明示表示。ブラウザ標準の非表示化や視認性の悪いアウトラインを排除。
- **スキップリンク（Skip Link）**: ページ最上部に `.skip_link` を配置。Tabキー押下時にのみ画面上部に展開され、共通ヘッダーをスキップして `<main id="main-content">` へ直接移動可能。

### 3. セマンティックHTMLとWAI-ARIA
- **パンくずリスト**: `<nav aria-label="現在位置">` および `<ol class="breadcrumb_list">`、各アイテムに `<li class="breadcrumb_item">`、現在地には `aria-current="page"` を付与。記号はスクリーンリーダーで過剰に読み上げられないようCSS装飾で実装。
- **記事目次**: `<nav class="article_toc" aria-label="目次">` として支援技術に目的を明示。
- **外部フレーム**: Googleマップ等の `<iframe>` には必ず日本語の `title` 属性を明記。
- **アニメーション低減配慮**: `@media (prefers-reduced-motion: reduce)` にて、OSの視覚効果低減設定を尊重したトランジション・アニメーション無効化を適用。

### 4. 共通ナビゲーションヘッダーおよびブランドロゴ設計
- **全ページ統一ヘッダー (`.site_header`)**:
  - トップページを含む全ページで共通のヘッダー構造（`.site_header` > `.header_inner` > `.header_brand`）を採用。
  - トップページではファーストビューのグラデーション背景と調和するよう透過スタイル（`.site_header_hero`）を併用し、右側に主要セクションへのナビゲーションリンク（`.header_nav`）を配置。
- **ロゴサイズ・位置の完全同期**:
  - ブランドロゴ（`.main_svg_logo`）は全ページ同一サイズ（PC: 幅 44px、スマホ: 幅 38px）に統一。
  - 下層ページからロゴをクリックしてトップへ戻った際にも、サイズ拡大や位置ジャンプが発生せず、シームレスかつ安定したUI体験を提供。
  - ヒーローコンテンツ上部にアイブロウ（`.hero_eyebrow`）を配置し、垂直方向の余白を最適化して画面全体の調和と視線誘導を強化。



