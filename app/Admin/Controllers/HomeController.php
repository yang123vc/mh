<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Browsing_history;
use App\Models\Cartoon;
use App\Models\User;
use Carbon\Carbon;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\InfoBox;
class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            //用户总数
            $user_count = User::all()->count();
            $yesterday_date = Carbon::yesterday();
            $today_date = Carbon::today();

            //今日访问IP
            $today_ip_count  =  Browsing_history::where('created_at','>',date('Y-m-d 00:00:00'))->count();
            //今日新增用户
            $today_user_count  =  User::where('created_at','>',date('Y-m-d 00:00:00'))->count();
            //昨日新增用户
            $yesterday_user_count  =  User::whereBetween('created_at',[$yesterday_date,$today_date])->count();
            //本周新增用户
            $toweek_user_count  =  User::whereBetween('created_at',[Carbon::now()->subWeek(0)->startOfWeek(),Carbon::now()->subWeek(0)->endOfWeek()])->count();
            //漫画总数
            $cartoon_count = Cartoon::all()->count();


            $count = $user_count.'------ '.$yesterday_user_count.'------ '.$toweek_user_count;
            $content->header('73漫画');
            $content->description('后台管理');
            $infoBox0 = new InfoBox('今日访问IP', 'users', 'aqua', '', $today_ip_count);
            $infoBox = new InfoBox('今日新增用户', 'users', 'aqua', '/admin/user', $today_user_count);
            $infoBox1 = new InfoBox('昨日新增用户', 'users', 'aqua', '/admin/user', $yesterday_user_count);
            $infoBox2 = new InfoBox('本周新增用户', 'users', 'aqua', '/admin/user', $toweek_user_count);
            $infoBox3 = new InfoBox('用户总数', 'users', 'aqua', '/admin/user', $user_count);
            $infoBox4 = new InfoBox('总漫画量', 'book', 'red', '/admin/cartoon', $cartoon_count);
            $content->body($infoBox0);
            $content->body($infoBox);
            $content->body($infoBox1);
            $content->body($infoBox2);
            $content->body($infoBox3);
            $content->body($infoBox4);
//            $content->row(function (Row $row) {
//
//                $row->column(4, function (Column $column) {
//                    $column->append(Dashboard::environment());
//                });
//
//                $row->column(4, function (Column $column) {
//                    $column->append(Dashboard::extensions());
//                });
//
//                $row->column(4, function (Column $column) {
//                    $column->append(Dashboard::dependencies());
//                });
//            });


        });


    }
}
