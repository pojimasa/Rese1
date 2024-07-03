<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
{
    $shops = [
        [
            'name' => '仙人',
            'location' => '東京都',
            'category' => '寿司',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg'
        ],
        [
            'name' => '牛助',
            'location' => '大阪府',
            'category' => '焼肉',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg'
        ],
        [
            'name' => '戦慄',
            'location' => '福岡県',
            'category' => '居酒屋',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg'
        ],
        [
            'name' => 'ルーク',
            'location' => '東京都',
            'category' => 'イタリアン',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg'
        ],
        [
            'name' => '志摩屋',
            'location' => '福岡県',
            'category' => 'ラーメン',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg'
        ],
        [
            'name' => '香',
            'location' => '東京都',
            'category' => '焼肉',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg'
        ],
        [
            'name' => 'JJ',
            'location' => '大阪府',
            'category' => 'イタリアン',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg'
        ],
        [
            'name' => 'らーめん極み',
            'location' => '東京都',
            'category' => 'ラーメン',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg'
        ],
        [
            'name' => '鳥雨',
            'location' => '大阪府',
            'category' => '居酒屋',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg'
        ],
        [
            'name' => '築地色合',
            'location' => '東京都',
            'category' => '寿司',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg'
        ],
        [
            'name' => '晴海',
            'location' => '大阪府',
            'category' => '焼肉',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg'
        ],
        [
            'name' => '三子',
            'location' => '福岡県',
            'category' => '焼肉',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg'
        ],
        [
            'name' => '八戒',
            'location' => '東京都',
            'category' => '居酒屋',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg'
        ],
        [
            'name' => '福助',
            'location' => '大阪府',
            'category' => '寿司',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg'
        ],
        [
            'name' => 'ラー北',
            'location' => '東京都',
            'category' => 'ラーメン',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg'
        ],
        [
            'name' => '翔',
            'location' => '大阪府',
            'category' => '居酒屋',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg'
        ],
        [
            'name' => '経緯',
            'location' => '東京都',
            'category' => '寿司',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg'
        ],
        [
            'name' => '漆',
            'location' => '東京都',
            'category' => '焼肉',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg'
        ],
        [
            'name' => 'THE TOOL',
            'location' => '福岡県',
            'category' => 'イタリアン',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg'
        ],
        [
            'name' => '木船',
            'location' => '大阪府',
            'category' => '寿司',
            'image' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg'
        ],
    ];

    return view('pages.home', ['shops' => $shops]);
}

}
