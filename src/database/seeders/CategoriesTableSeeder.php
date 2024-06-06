<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            // トップレベルカテゴリー
            ['name' => 'ファッション', 'parent_id' => NULL],
            ['name' => '書籍', 'parent_id' => NULL],
            ['name' => 'スポーツ用品', 'parent_id' => NULL],
            ['name' => 'おもちゃ', 'parent_id' => NULL],
            ['name' => '家具', 'parent_id' => NULL],
            ['name' => 'アクセサリー', 'parent_id' => NULL],
            ['name' => '健康・美容', 'parent_id' => NULL],
            ['name' => '音楽', 'parent_id' => NULL],
            ['name' => 'アート', 'parent_id' => NULL],

            // 子要素
            ['name' => 'メンズ', 'parent_id' => 1], //10
            ['name' => 'レディース', 'parent_id' => 1], //11
            ['name' => 'キッズ', 'parent_id' => 1], //12
            ['name' => '小説', 'parent_id' => 2], //13
            ['name' => '教育', 'parent_id' => 2], //14
            ['name' => '趣味', 'parent_id' => 2], //15
            ['name' => '野球', 'parent_id' => 3], //16
            ['name' => 'サッカー', 'parent_id' => 3], //17
            ['name' => 'テニス', 'parent_id' => 3], //18
            ['name' => 'ブロック', 'parent_id' => 4], //19
            ['name' => 'アクションフィギュア', 'parent_id' => 4], //20
            ['name' => 'パズル', 'parent_id' => 4], //21
            ['name' => 'リビングルーム', 'parent_id' => 5], //22
            ['name' => 'ベッドルーム', 'parent_id' => 5], //23
            ['name' => 'オフィス', 'parent_id' => 5], //24
            ['name' => 'ジュエリー', 'parent_id' => 6], //25
            ['name' => '時計', 'parent_id' => 6], //26
            ['name' => 'バッグ', 'parent_id' => 6], //27
            ['name' => 'スキンケア', 'parent_id' => 7], //28
            ['name' => 'ヘアケア', 'parent_id' => 7], //29
            ['name' => 'フィットネス', 'parent_id' => 7], //30
            ['name' => '楽器', 'parent_id' => 8], //31
            ['name' => 'レコード', 'parent_id' => 8], //32
            ['name' => 'アクセサリー', 'parent_id' => 8], //33
            ['name' => '絵画', 'parent_id' => 9], //34
            ['name' => '彫刻', 'parent_id' => 9], //35
            ['name' => '工芸', 'parent_id' => 9], //36

            // 孫要素
            ['name' => 'Tシャツ', 'parent_id' => 10],
            ['name' => 'ジーンズ', 'parent_id' => 10],
            ['name' => 'ジャケット', 'parent_id' => 10],
            ['name' => 'スニーカー', 'parent_id' => 10],
            ['name' => 'サングラス', 'parent_id' => 10],
            ['name' => 'ドレス', 'parent_id' => 11],
            ['name' => 'スカート', 'parent_id' => 11],
            ['name' => 'ブラウス', 'parent_id' => 11],
            ['name' => 'ハイヒール', 'parent_id' => 11],
            ['name' => 'バッグ', 'parent_id' => 11],
            ['name' => 'シャツ', 'parent_id' => 12],
            ['name' => 'パンツ', 'parent_id' => 12],
            ['name' => 'スニーカー', 'parent_id' => 12],
            ['name' => '帽子', 'parent_id' => 12],
            ['name' => 'リュックサック', 'parent_id' => 12],

            ['name' => '文学', 'parent_id' => 13],
            ['name' => 'サスペンス', 'parent_id' => 13],
            ['name' => 'ロマンス', 'parent_id' => 13],
            ['name' => 'ファンタジー', 'parent_id' => 13],
            ['name' => 'ミステリー', 'parent_id' => 13],
            ['name' => '教科書', 'parent_id' => 14],
            ['name' => '参考書', 'parent_id' => 14],
            ['name' => '問題集', 'parent_id' => 14],
            ['name' => '辞書', 'parent_id' => 14],
            ['name' => '語学', 'parent_id' => 14],
            ['name' => '料理', 'parent_id' => 15],
            ['name' => 'ガーデニング', 'parent_id' => 15],
            ['name' => '旅行', 'parent_id' => 15],
            ['name' => '写真', 'parent_id' => 15],
            ['name' => '手芸', 'parent_id' => 15],

            ['name' => 'バット', 'parent_id' => 16],
            ['name' => 'グローブ', 'parent_id' => 16],
            ['name' => 'ボール', 'parent_id' => 16],
            ['name' => 'ユニフォーム', 'parent_id' => 16],
            ['name' => 'キャップ', 'parent_id' => 16],
            ['name' => 'ボール', 'parent_id' => 17],
            ['name' => 'スパイク', 'parent_id' => 17],
            ['name' => 'ユニフォーム', 'parent_id' => 17],
            ['name' => 'シンガード', 'parent_id' => 17],
            ['name' => 'ゴールキーパーグローブ', 'parent_id' => 17],
            ['name' => 'ラケット', 'parent_id' => 18],
            ['name' => 'ボール', 'parent_id' => 18],
            ['name' => 'シューズ', 'parent_id' => 18],
            ['name' => 'ウェア', 'parent_id' => 18],
            ['name' => 'サングラス', 'parent_id' => 18],

            ['name' => 'レゴ', 'parent_id' => 19],
            ['name' => 'メガブロック', 'parent_id' => 19],
            ['name' => 'コンクリートブロック', 'parent_id' => 19],
            ['name' => 'ウッドブロック', 'parent_id' => 19],
            ['name' => 'フォームブロック', 'parent_id' => 19],
            ['name' => 'スーパーヒーロー', 'parent_id' => 20],
            ['name' => 'ロボット', 'parent_id' => 20],
            ['name' => 'モンスター', 'parent_id' => 20],
            ['name' => '映画キャラクター', 'parent_id' => 20],
            ['name' => 'アニメキャラクター', 'parent_id' => 20],
            ['name' => 'ジグソーパズル', 'parent_id' => 21],
            ['name' => '木製パズル', 'parent_id' => 21],
            ['name' => '3Dパズル', 'parent_id' => 21],
            ['name' => 'ロジックパズル', 'parent_id' => 21],
            ['name' => 'スライディングパズル', 'parent_id' => 21],

            ['name' => 'ソファ', 'parent_id' => 22],
            ['name' => 'コーヒーテーブル', 'parent_id' => 22],
            ['name' => 'テレビ台', 'parent_id' => 22],
            ['name' => '本棚', 'parent_id' => 22],
            ['name' => 'ランプ', 'parent_id' => 22],
            ['name' => 'ベッド', 'parent_id' => 23],
            ['name' => 'ナイトテーブル', 'parent_id' => 23],
            ['name' => 'ドレッサー', 'parent_id' => 23],
            ['name' => 'クローゼット', 'parent_id' => 23],
            ['name' => '鏡', 'parent_id' => 23],
            ['name' => 'デスク', 'parent_id' => 24],
            ['name' => 'チェア', 'parent_id' => 24],
            ['name' => '本棚', 'parent_id' => 24],
            ['name' => 'ファイルキャビネット', 'parent_id' => 24],
            ['name' => 'デスクランプ', 'parent_id' => 24],

            ['name' => 'ネックレス', 'parent_id' => 25],
            ['name' => 'ブレスレット', 'parent_id' => 25],
            ['name' => 'イヤリング', 'parent_id' => 25],
            ['name' => 'リング', 'parent_id' => 25],
            ['name' => 'アンクレット', 'parent_id' => 25],
            ['name' => 'アナログ時計', 'parent_id' => 26],
            ['name' => 'デジタル時計', 'parent_id' => 26],
            ['name' => 'スマートウォッチ', 'parent_id' => 26],
            ['name' => '懐中時計', 'parent_id' => 26],
            ['name' => 'スポーツウォッチ', 'parent_id' => 26],
            ['name' => 'ハンドバッグ', 'parent_id' => 27],
            ['name' => 'リュックサック', 'parent_id' => 27],
            ['name' => 'ショルダーバッグ', 'parent_id' => 27],
            ['name' => 'トートバッグ', 'parent_id' => 27],
            ['name' => 'クラッチバッグ', 'parent_id' => 27],

            ['name' => 'クレンザー', 'parent_id' => 28],
            ['name' => 'トナー', 'parent_id' => 28],
            ['name' => 'モイスチャライザー', 'parent_id' => 28],
            ['name' => '日焼け止め', 'parent_id' => 28],
            ['name' => '美容液', 'parent_id' => 28],
            ['name' => 'シャンプー', 'parent_id' => 29],
            ['name' => 'コンディショナー', 'parent_id' => 29],
            ['name' => 'ヘアマスク', 'parent_id' => 29],
            ['name' => 'スタイリングジェル', 'parent_id' => 29],
            ['name' => 'ヘアスプレー', 'parent_id' => 29],
            ['name' => 'ヨガマット', 'parent_id' => 30],
            ['name' => 'ダンベル', 'parent_id' => 30],
            ['name' => 'トレッドミル', 'parent_id' => 30],
            ['name' => 'エクササイズバンド', 'parent_id' => 30],
            ['name' => 'フィットネスボール', 'parent_id' => 30],

            ['name' => 'ギター', 'parent_id' => 31],
            ['name' => 'ピアノ', 'parent_id' => 31],
            ['name' => 'ドラム', 'parent_id' => 31],
            ['name' => 'バイオリン', 'parent_id' => 31],
            ['name' => 'トランペット', 'parent_id' => 31],
            ['name' => 'クラシック', 'parent_id' => 32],
            ['name' => 'ロック', 'parent_id' => 32],
            ['name' => 'ジャズ', 'parent_id' => 32],
            ['name' => 'ポップ', 'parent_id' => 32],
            ['name' => 'ヒップホップ', 'parent_id' => 32],
            ['name' => 'ヘッドフォン', 'parent_id' => 33],
            ['name' => 'スピーカー', 'parent_id' => 33],
            ['name' => 'マイクロフォン', 'parent_id' => 33],
            ['name' => 'ミキサー', 'parent_id' => 33],
            ['name' => 'アンプ', 'parent_id' => 33],

            ['name' => '油絵', 'parent_id' => 34],
            ['name' => '水彩画', 'parent_id' => 34],
            ['name' => 'アクリル画', 'parent_id' => 34],
            ['name' => 'パステル画', 'parent_id' => 34],
            ['name' => 'インク画', 'parent_id' => 34],
            ['name' => '木彫', 'parent_id' => 35],
            ['name' => '石彫', 'parent_id' => 35],
            ['name' => '金属彫', 'parent_id' => 35],
            ['name' => 'クレイ彫', 'parent_id' => 35],
            ['name' => 'ガラス彫', 'parent_id' => 35],
            ['name' => '陶芸', 'parent_id' => 36],
            ['name' => '編み物', 'parent_id' => 36],
            ['name' => '織物', 'parent_id' => 36],
            ['name' => '刺繍', 'parent_id' => 36],
            ['name' => 'ガラス工芸', 'parent_id' => 36],
        ];

        DB::table('categories')->insert($categories);
    }
}
