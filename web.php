<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
////////////////微信
///粉丝
Route::get('/wechat/get_user_info','WechatController@get_user_info');
Route::get('/wechat/get_user_list','WechatController@get_user_list');
Route::get('/wechat/get_user_lists','WechatController@get_user_lists');
Route::get('/wechat/detail','WechatController@detail');
//微信授权
Route::get('/wechat/get_access_token','WechatController@get_access_token');
Route::get('/wechat/code','WechatController@code');
Route::get('/wechat/login','WechatController@login');
Route::get('/wechat/push_template','WechatController@push_template');
Route::get('/wechat/template_list','WechatController@template_list');
//上传
Route::get('/wechat/upload_source','WechatController@upload_source');
Route::post('/wechat/do_upload','WechatController@do_upload');
//标签
Route::get('/wechat/tagList','WechatController@tag_list');
Route::get('/wechat/add_tag','WechatController@add_tag');
Route::get('/wechat/do_add_tag','WechatController@do_add_tag');
Route::get('/wechat/del_tag','WechatController@del_tag');
Route::get('/wechat/tag_user','WechatController@tag_user');
Route::get('/wechat/user_list','WechatController@user_list');
Route::get('/wechat/add_user_tag','WechatController@add_user_tag');
Route::get('/wechat/create_qrcode','WechatController@create_qrcode');
///////////////
Route::get('/index/index','home\indexController@index');
Route::get('/home/login','home\IndexController@login');
Route::get('/home/do_login','home\IndexController@do_login');
Route::get('/home/register','home\IndexController@register');
Route::get('/home/do_register','home\IndexController@do_register');
Route::get('/admin/goods','admin\GoodsController@goodsList');
Route::get('/admin/add_goods','admin\GoodsController@add_goods');
Route::post('/admin/do_add_goods','admin\GoodsController@do_add_goods');
Route::get('/admin/delete','admin\GoodsController@delete');
Route::post('/admin/do_update','admin\GoodsController@do_update');
Route::get('/admin/update','admin\GoodsController@update');
//后台
Route::get('/admin/login','admin\AdminLogin@AdminLogin');
Route::get('/admin/do_login','admin\AdminLogin@Admin_do_login');
//购物车
Route::get('/home/add_cart','home\IndexController@add_cart');
Route::get('/home/cartList','home\IndexController@cartList');
Route::get('/car/create','CarController@create');
Route::get('/car/index','CarController@index');
Route::get('/order/order_index','Order@order_index');
Route::get('/order/indexs','Order@order_indexs');
Route::get('/order/create','Order@create');

Route::get('/student/index', 'StudentController@index');
Route::post('/student/do_add','StudentController@do_add');
Route::get('/student/update','StudentController@update');
Route::post('/student/do_update','StudentController@do_update');
Route::get('/student/delete','StudentController@delete');
// Route::get('/student/login','StudentController@login');
// Route::post('/student/do_login','StudentController@do_login');

// Route::get('/admin/add_goods','admin\GoodsController@add_goods');
Route::get('/home/index','home\GoodsController@do_add_goods');
//车票考试
Route::get('/admin/add_ticket','admin\TicketController@add_ticket');
Route::post('/admin/do_add_ticket','admin\TicketController@do_add_ticket');
Route::get('/admin/ticketList','admin\TicketController@ticketList');

//考试系统
Route::get('/admin/exam/login','admin\ExamSystem@login');
Route::post('/admin/exam/do_login','admin\ExamSystem@do_login');
Route::get('/admin/exam/index','admin\ExamSystem@index');
Route::get('/admin/exam/add','admin\ExamSystem@add');
Route::get('/admin/exam/aadd','admin\ExamSystem@aadd');
Route::get('/admin/exam/do_aadd','admin\ExamSystem@do_aadd');
Route::get('/admin/exam/examList','admin\ExamSystem@examList');
Route::get('/exam/detail','admin\ExamSystem@detail');

//调研系统
Route::get('/admin/survey/login','admin\Survey@login');
Route::get('/admin/survey/do_login','admin\Survey@do_login');
Route::get('/admin/survey/index','admin\Survey@index');
Route::get('/admin/survey/do_add','admin\Survey@do_add');
Route::get('/admin/survey/survey','admin\Survey@survey');
Route::get('/admin/survey/surveys','admin\Survey@surveys');
Route::get('/admin/survey/list','admin\Survey@list');
Route::get('/admin/survey/add_question','admin\Survey@add_question');
Route::get('/admin/survey/use','admin\Survey@use');
//比赛
Route::get('/admin/tournament/add','admin\Tournament@add');
Route::get('/admin/tournament/do_add','admin\Tournament@do_add');
Route::get('/admin/tournament/guesslist','admin\Tournament@guesslist');
Route::get('/admin/tournament/guessing','admin\Tournament@guessing');
Route::get('/admin/tournament/result','admin\Tournament@result');
Route::get('/admin/tournament/do_add_guessing','admin\Tournament@do_add_guessing');
Route::get('/admin/tournament/adminresult','admin\Tournament@adminresult');
//车库管理系统
Route::get('/admin/parking/login','admin\Parking@login');
Route::get('/admin/parking/do_login','admin\Parking@do_login');
Route::get('/admin/parking/index','admin\Parking@index');
Route::get('/admin/parking/add_doorkeeper','admin\Parking@add_doorkeeper');
Route::post('/admin/parking/do_add_doorkeeper','admin\Parking@do_add_doorkeeper');
Route::get('/admin/parking/add_cartnumber','admin\Parking@add_cartnumber');
Route::post('/admin/parking/do_add_cartnumber','admin\Parking@do_add_cartnumber');
Route::get('/parking/doorkeeperlogin','admin\Parking@doorkeeperlogin');
Route::post('/parking/do_doorkeeperlogin','admin\Parking@do_doorkeeperlogin');
Route::get('/parking/door_index','admin\Parking@door_index');
Route::get('/parking/entry','admin\Parking@entry');
Route::post('/parking/do_entry','admin\Parking@do_entry');
//接口
Route::get('/index/jiekou','Controller@index');
//考试
Route::get('/news/login','News@login');
Route::get('/news/do_login','News@do_login');
Route::get('/news/index','News@index');
Route::get('/news/add_news','News@add_news');
Route::post('/news/do_add_news','News@do_add_news');
Route::get('/news/delete','News@delete');
Route::get('/news/show','News@show');
//接口
Route::post('liuyan_info','Liuyan@liuyan_info');


//调用中间件
Route::group(['middleware' => ['login']], function () {
    //添加学生信息
Route::get('/student/add','StudentController@add');

});


//调用中间件
Route::group(['middleware' => ['GoodsUpdate']], function () {
    //商品修改
    Route::get('/admin/update','admin\GoodsController@update');

});

//调用中间件
Route::group(['middleware' => ['guessing']], function () {
    //竞猜guessing
    Route::get('/admin/tournament/guessing','admin\Tournament@guessing');

});
//调用中间件
Route::group(['middleware' => ['guesslist']], function () {
    //竞猜guessing
    Route::get('/admin/tournament/guesslist','admin\Tournament@guesslist');

});
//调用中间件
Route::group(['middleware' => ['deletenews']], function () {
    //删除
Route::get('/student/add','News@delete');

});
