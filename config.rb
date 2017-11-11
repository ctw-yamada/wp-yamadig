
require 'compass/import-once/activate'
# Compassプラグイン利用時に記述
# プロジェクトディレクトリの設定
http_path       = "/"      #サイトディレクトリ
css_dir         = "/"      #CSS書き出しディレクトリ
sass_dir        = "sass"      #SASSファイル配置ディレクトリ
#images_dir      = "img" #画像用ディレクトリ
javascripts_dir = "js"     #JavaScriptファイル用ディレクトリ
 
# アウトプットスタイル（デフォルト：expanded）
# output_style = :expanded   #一般的なCSS記述スタイル
# output_style = :nested     #Sassなどのネストを継承したスタイル
output_style = :compact      #1つのCSS設定が１行になるスタイル
# output_style = :compressed #コメント完全削除+圧縮するスタイル
 
# Compass拡張関数で使うURLを絶対パスか相対パスかで指定（デフォルト：false[絶対パス]）
relative_assets = true
 
line_comments = false
 
preferred_syntax = :scss