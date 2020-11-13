<?php

define('MAX', '4'); // 1ページの記事の表示数
class Paginate
{
    public $post_num;
    public $max_page;
    public $start_no;
    public $end_no;
    public $now;

    function __construct($post_num,$page_id)
    {
        $this->post_num = $post_num;
        $this->max_page = ceil($this->post_num / MAX);
        if (!isset($page_id)) { // $_GET['page_id'] はURLに渡された現在のページ数
            $this->now = 1; // 設定されてない場合は1ページ目にする
        } else {
            $this->now = $page_id;
        }
        $this->start_no = ($this->now - 1) * MAX; // 配列の何番目から取得すればよいか
        $this->end_no=$this->start_no+(MAX-1);
    }

    public function is_first()
    {
        return $this->now==1;
    }

    public function is_end()
    {
        return $this->now==$this->max_page;
    }

    public function slice_array($posts)
    {
        $disp_data = array_slice($posts, $this->start_no, MAX, true);
        return $disp_data;
    }
}