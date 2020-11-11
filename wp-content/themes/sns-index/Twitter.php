<?php
// TwitterOAuthを利用するためComposerのautoload.phpを読み込み
require __DIR__ . '/vendor/autoload.php';

// TwitterOAuthクラスをインポート
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{
    private $CK = 'XMCdmPCe10mSHMmMydy0UmsXS'; // Consumer Keyをセット
    private $CS = 'Xv2XfK2ZtzWT5pFMilwDZhBHYRn6UuRuKcEHoP0DZ3M6Lzd9Qk'; // Consumer Secretをセット
    private $AT = '1273087480862961664-ZkEW5Tc632xu4UYincRMa26pR1iCO5'; // Access Tokenをセット
    private $AS = 'B8OHd8XtQYRdlkFvSAWtYprYybMSl08UFG3ctY7T6fXP0'; // Access Token Secretをセット
    private $posts;

    function __construct($userName,$is_reply)
    {
        // TwitterOAuthクラスのインスタンスを作成
        $connect = new TwitterOAuth($this->CK, $this->CS, $this->AT, $this->AS);

        if ($is_reply == '1') {
            $this->posts = $connect->get(
                'statuses/user_timeline',
                // 取得するツイートの条件を配列で指定
                array(
                    // ユーザー名（@は不要）
                    'screen_name' => $userName,
                    // ツイート件数
                    'count' => '4',
                    // リプライを除外するかを、true（除外する）、false（除外しない）で指定
                    'exclude_replies' => 'false',
                    // リツイートを含めるかを、true（含める）、false（含めない）で指定
                    'include_rts' => 'true',
                )
            );
        } else {
            $this->posts = $connect->get(
                'statuses/user_timeline',
                // 取得するツイートの条件を配列で指定
                array(
                    // ユーザー名（@は不要）
                    'screen_name' => $userName,
                    // ツイート件数
                    'count' => '4',
                    // リプライを除外するかを、true（除外する）、false（除外しない）で指定
                    'exclude_replies' => 'true',
                    // リツイートを含めるかを、true（含める）、false（含めない）で指定
                    'include_rts' => 'true',
                )
            );
        }
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function is_RT($tweet)
    {
        $text=substr($tweet,0,2);
        return $text=='RT';
    }

    public function add_color_rts($tweet)
    {
        $text=substr_replace($tweet,"<span class='rt'>RT",0,2);
        $text = str_replace(':', ":</span>", $text);
        return $text;
    }
}