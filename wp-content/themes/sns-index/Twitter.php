<?php
// TwitterOAuthを利用するためComposerのautoload.phpを読み込み
require __DIR__ . '/vendor/autoload.php';

// TwitterOAuthクラスをインポート
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{
    // Twitter APIを利用する認証情報。xxxxxxxxの箇所にそれぞれ情報を指定
    private $CK = 'XMCdmPCe10mSHMmMydy0UmsXS'; // Consumer Keyをセット
    private $CS = 'Xv2XfK2ZtzWT5pFMilwDZhBHYRn6UuRuKcEHoP0DZ3M6Lzd9Qk'; // Consumer Secretをセット
    private $AT = '1273087480862961664-ZkEW5Tc632xu4UYincRMa26pR1iCO5'; // Access Tokenをセット
    private $AS = 'B8OHd8XtQYRdlkFvSAWtYprYybMSl08UFG3ctY7T6fXP0'; // Access Token Secretをセット
    private $posts;

    function __construct($userName)
    {
        // TwitterOAuthクラスのインスタンスを作成
        $connect = new TwitterOAuth( $this->CK, $this->CS, $this->AT, $this->AS );

        $this->posts = $connect->get(
            'statuses/user_timeline',
            // 取得するツイートの条件を配列で指定
            array(
                // ユーザー名（@は不要）
                'screen_name'       => $userName,
                // ツイート件数
                'count'             => '4',
                // リプライを除外するかを、true（除外する）、false（除外しない）で指定
                'exclude_replies'   => 'true',
                // リツイートを含めるかを、true（含める）、false（含めない）で指定
                'include_rts'       => 'true',
                'auto_populate_reply_metadata'=>'true',
            )
        );
    }

    public function getPosts()
    {
        return $this->posts;
    }

}