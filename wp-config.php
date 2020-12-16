<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'wp_sns_index_page_ver1' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'root' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'sora1220' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'localhost' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'RC{No(b/[:~(d_2KF}E(tt3%!dIQ!?-C@$P`I;04iWs{ QBi%q6|=jBBK`U$y4{G' );
define( 'SECURE_AUTH_KEY',  'c hUN{n%,PU<lV8YM%<:kd#<0G(W g.M/TyLj;vfE.];1!]{j&+-<3k$[rIs3<UA' );
define( 'LOGGED_IN_KEY',    '33e*r= Jp3u,cI?S;ODpRp;@(G,/b65OwbM(^qiMfiYZH>5<j[cl5+#X7Z0S9MEG' );
define( 'NONCE_KEY',        '$zp(;Xv+E@s_]y955XToP{<#OR>/xR4i5{>4~9-}i3,dJ$?-TP2Qf]WO.olPP`Ho' );
define( 'AUTH_SALT',        'W%9:TwIlA,-jnraH0Na|]DmbqQw#!Hz(:.zD[kq,DJ8rb8D]6 (3{!an6_tF<b8F' );
define( 'SECURE_AUTH_SALT', '6UV{qhN]>t(S>Q!E6j3mVMWt?<#|D~Q^4DRf`)(~c{+f~N/2e)M;/~isgxt.fvkw' );
define( 'LOGGED_IN_SALT',   '+B`4~l#VEa/v_J#vh]dgVT9 9^$hTYk:8[A+%]Wb#RBSBe}HK}<m-_<6Hf,9*fpe' );
define( 'NONCE_SALT',       'p#J#ljW39f2k`ZY2^+5NV{HkOVc?FLP--f1AdAydLf dPC6^!eSEa)<Wh% 5ImPm' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
