<?php get_header(); ?>
        <h2>index</h2>
<?php
// TwitterOAuthを利用するためComposerのautoload.phpを読み込み
require __DIR__ . '/vendor/autoload.php';
// TwitterOAuthクラスをインポート
use Abraham\TwitterOAuth\TwitterOAuth;

// Twitter APIを利用する認証情報。xxxxxxxxの箇所にそれぞれの情報を指定
$CK = 'XMCdmPCe10mSHMmMydy0UmsXS'; // Consumer Keyをセット
$CS = 'Xv2XfK2ZtzWT5pFMilwDZhBHYRn6UuRuKcEHoP0DZ3M6Lzd9Qk'; // Consumer Secretをセット
$AT = '1273087480862961664-ZkEW5Tc632xu4UYincRMa26pR1iCO5'; // Access Tokenをセット
$AS = 'B8OHd8XtQYRdlkFvSAWtYprYybMSl08UFG3ctY7T6fXP0'; // Access Token Secretをセット

// TwitterOAuthクラスのインスタンスを作成
$connect = new TwitterOAuth( $CK, $CS, $AT, $AS );

$statuses = $connect->get(
    'statuses/user_timeline',
    // 取得するツイートの条件を配列で指定
    array(
        // ユーザー名（@は不要）
        'screen_name'       => 'nira_22222',
        // ツイート件数
        'count'             => '20',
        // リプライを除外するかを、true（除外する）、false（除外しない）で指定
        'exclude_replies'   => 'true',
        // リツイートを含めるかを、true（含める）、false（含めない）で指定
        'include_rts'       => 'true'
    )
);

// ツイート本文を格納する変数
$text_list = [];
// 取得したツイート情報のオブジェクトから、ツイート本文を取得し配列$id_listに格納
foreach( $statuses as $tweet ){
    $text = $tweet->text;
    array_push( $text_list, $text );
    echo "<div>$text</div>";
}
?>
<?php get_footer(); ?>