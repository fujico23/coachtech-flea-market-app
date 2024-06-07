<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DefaultComment;


class DefaultCommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DefaultComment::create([
            'title' => 'お値下げをお願いする',
            'comment' => 'コメント失礼いたします。購入を考えているのですが、こちらの商品はお値下げ可能でしょうか？',
        ]);
        DefaultComment::create([
            'title' => '商品状態を確認したい',
            'comment' => 'コメント失礼いたします。商品の状態を確認させてください。',
        ]);
        DefaultComment::create([
            'title' => '写真の追加を依頼したい',
            'comment' => 'コメント失礼いたします。写真を追加していただけないでしょうか？',
        ]);
        DefaultComment::create([
            'title' => '購入可能か確認したい',
            'comment' => 'コメント失礼いたします。こちらの商品はまだ購入可能でしょうか？',
        ]);
        DefaultComment::create([
            'title' => '発送までの日数を確認したい',
            'comment' => 'コメント失礼いたします。こちらの商品は、いつ頃発送いただけますでしょうか？',
        ]);
    }
}
