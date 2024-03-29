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
// 后台
Route::get('/admin/index','admin\AdminController@index');
Route::get('/admin/add','admin\AdminController@add');
Route::post('/admin/do_add','admin\AdminController@do_add');
Route::get('/admin/del','admin\AdminController@del');
Route::get('/admin/update','admin\AdminController@update');
Route::post('/admin/do_update','admin\AdminController@do_update');
// 后台登录
Route::get('/admin/login','admin\AdminController@login');
Route::post('/admin/do_login','admin\AdminController@do_login');
// 后台注册
Route::get('/admin/register','admin\AdminController@register');
Route::post('/admin/do_register','admin\AdminController@do_register');
Route::get('/User/index','admin\User@index');
// 周考
Route::get('/Studen/index','zhokao\Studen@index');
Route::get('/Studen/add','zhokao\Studen@add');
Route::post('/Studen/do_add','zhokao\Studen@do_add');



Route::get('return_url','PayController@return_url');// 同步
Route::post('notify_url','PayController@notify_url');// 异步
Route::get('pay', 'PayController@pay');


// 前台
Route::get('/home/index','home\indexController@index');
Route::get('/home/product','home\indexController@product');
Route::get('/home/do_product','home\indexController@do_product');
Route::get('/home/cart','home\indexController@cart');
Route::get('/home/order','home\indexController@order');
Route::get('/home/order_create','home\indexController@order_create');
Route::get('/home/order_del','home\indexController@order_del');
Route::post('/home/order_status','home\indexController@order_status');
Route::get('/home/order_detail','home\indexController@order_detail');
Route::get('/home/order_index','home\indexController@order_index');

//月考
Route::get('/kaoshi/token','kaoshi\KaoshiController@token');
Route::get('/kaoshi/huifu','kaoshi\KaoshiController@huifu');



// 周考
Route::get('/comm/index','CommController@index');
Route::get('/comm/insert','CommController@insert');
Route::post('/comm/do_insert','CommController@do_insert');
Route::get('/comm/del','CommController@del');


//作业 调研
Route::get('diaoyan/login','zuoye\Diaoyan@login');
Route::post('diaoyan/login_do','zuoye\Diaoyan@login_do');
Route::get('diaoyan/list','zuoye\Diaoyan@list');
Route::get('diaoyan/add_probject','zuoye\Diaoyan@add_probject');
Route::post('diaoyan/add_probject_do','zuoye\Diaoyan@add_probject_do');
Route::get('diaoyan/add_question','zuoye\Diaoyan@add_question');
Route::post('diaoyan/add_question_do','zuoye\Diaoyan@add_question_do');
Route::get('diaoyan/add_option','zuoye\Diaoyan@add_option');
Route::post('diaoyan/add_option_do','zuoye\Diaoyan@add_option_do');
Route::get('diaoyan/start','zuoye\Diaoyan@start');
Route::get('diaoyan/del','zuoye\Diaoyan@del');
Route::get('diaoyan/monthly','zuoye\Diaoyan@monthly');

//作业
Route::get('question/add','QuestionController@add');
Route::post('question/do_add','QuestionController@do_add');
Route::get('question/list','QuestionController@index');
Route::get('question/add_papers','QuestionController@add_papers');
Route::post('question/do_add_papers','QuestionController@do_add_papers');
Route::post('question/insert_papers','QuestionController@insert_papers');
Route::get('question/test_list','QuestionController@test_list');
Route::get('question/test_detail','QuestionController@test_detail');


// 作业竞猜
Route::get('guess/add','zuoye\GuessController@add');
Route::post('guess/do_add','zuoye\GuessController@do_add');
Route::get('guess/index','zuoye\GuessController@index');
Route::get('guess/gues/{id}','zuoye\GuessController@gues');
Route::get('guess/result/{id}','zuoye\GuessController@result');
Route::get('guess/gue_add','zuoye\GuessController@gue_add');
Route::get('guess/gue_index','zuoye\GuessController@gue_index');
Route::post('guess/update','zuoye\GuessController@update');

// 上个月考试题A
Route::get('monthly/login','kaoshiController@login');
Route::post('monthly/dologin','kaoshiController@dologin');
Route::get('monthly/logout','kaoshiController@logout');
Route::middleware(['login'])->group(function(){
    Route::get('monthly/index','kaoshiController@index');
    Route::get('monthly/addcar','kaoshiController@addcar');
    Route::post('monthly/doaddcar','kaoshiController@doaddcar');
    Route::get('monthly/addmenwei','kaoshiController@addmenwei');
    Route::post('monthly/doaddmenwei','kaoshiController@doaddmenwei');
    Route::get('monthly/admin','kaoshiController@admin');
    Route::get('monthly/carin','kaoshiController@carin');
    Route::post('monthly/docarin','kaoshiController@docarin');
    Route::get('monthly/carout','kaoshiController@carout');
    Route::post('monthly/docarout','kaoshiController@docarout');
    Route::get('monthly/detail','kaoshiController@detail');
    Route::get('monthly/info','kaoshiController@info');
});

// 经纬度练习
Route::get('long/index','long\LongitudeController@index');
Route::post('info','long\LongitudeController@info');

// 作业
Route::get('zuo/register','zuoye\ZuoController@register');
Route::post('zuo/do_register','zuoye\ZuoController@do_register');



////////////////////////////////////////////////////////////////////////////////////////
///菜单管理
Route::get('/menu/menu_list','menu\MenuController@menu_list');
Route::post('/menu/do_add_menu','menu\MenuController@do_add_menu');
Route::get('/menu/display_menu','menu\MenuController@display_menu');

//表白

Route::get('/biaobai/index','biaobai\BiaobaiController@index');
Route::get('/biaobai/send','biaobai\BiaobaiController@send');
Route::post('/biaobai/do_send','biaobai\BiaobaiController@do_send');
Route::get('/biaobai/xxoo','biaobai\BiaobaiController@xxoo');






Route::get('/wechat/get_info','wechat\WechatController@get_info');
Route::get('/wechat/get_list','wechat\WechatController@get_list');
Route::get('/wechat/index','wechat\WechatController@index');
Route::get('/wechat/tang/{id}','wechat\WechatController@tang');
Route::get('/wechat/code','wechat\WechatController@code');
Route::get('/wechat/login','wechat\WechatController@login');
Route::get('/wechat/template_list','wechat\WechatController@template_list');
Route::get('/wechat/del_template','wechat\WechatController@del_template');
Route::get('/wechat/push_template','wechat\WechatController@push_template');
Route::get('/wechat/upload_source','wechat\WechatController@upload_source');
Route::post('/wechat/do_upload','wechat\WechatController@do_upload');
Route::get('/wechat/get_voice_source','wechat\WechatController@get_voice_source');
Route::get('/wechat/get_source','wechat\WechatController@get_source');
Route::get('/wechat/get_video_source','wechat\WechatController@get_video_source');
Route::get('/wechat/get_label','wechat\WechatController@get_label');
Route::post('/wechat/do_get_label','wechat\WechatController@do_get_label');
Route::get('/wechat/get_label_list','wechat\WechatController@get_label_list');
Route::get('/wechat/tang_del','wechat\WechatController@tang_del');
Route::get('/wechat/tang_user','wechat\WechatController@tang_user');
Route::get('/wechat/get_user_tang','wechat\WechatController@get_user_tang');
Route::post('/wechat/add_tang','wechat\WechatController@add_tang');
Route::get('/wechat/get_update/{name}','wechat\WechatController@get_update');
Route::post('/wechat/do_get_update','wechat\WechatController@do_get_update');
Route::get('wechat/push_tang','wechat\WechatController@push_tang');
Route::post('wechat/do_push_tang','wechat\WechatController@do_push_tang');
Route::get('wechat/ticket','wechat\WechatController@ticket');
Route::get('wechat/tangtang','wechat\WechatController@tangtang');
///////////////////////////////////////////////////////////////////////////////////////
Route::get('agent/user_list','agent\AgentController@user_list');
Route::get('agent/creat_qrcode','agent\AgentController@creat_qrcode');
Route::get('agent/agent_list','agent\AgentController@agent_list');
Route::get('agent/tanghu','agent\AgentController@tanghu');
Route::get('agent/add','agent\AgentController@add');
Route::post('agent/do_add','agent\AgentController@do_add');
/// /////////////////////////////////////////////////////////////////////////////////////////




//月考
Route::get('monthly/index','monthly\Monthly@index');
Route::get('monthly/login','monthly\Monthly@login');
Route::post('monthly/do_login','monthly\Monthly@do_login');
Route::post('monthly/add','monthly\Monthly@add');
Route::get('monthly/del','monthly\Monthly@del');

//留言
Route::get('/liuyan/token','liuyan\liuyanController@token');
Route::get('/liuyan/do_login','liuyan\liuyanController@do_login');
Route::get('/liuyan/get_list','liuyan\liuyanController@get_list');
Route::post('/liuyan/liuyan_add','liuyan\liuyanController@liuyan_add');
Route::get('/liuyan/index','liuyan\liuyanController@index');
Route::post('/liuyan/liuyan_doadd','liuyan\liuyanController@liuyan_doadd');
Route::get('/liuyan/login','liuyan\liuyanController@login');
Route::get('/liuyan/code','liuyan\liuyanController@code');



//9月
Route::get('/aadmin/login','aadmin\AadminController@login');
Route::get('/aadmin/index','aadmin\AadminController@index');
Route::get('/aadmin/insert','aadmin\AadminController@insert');
Route::any('/aadmin/do_insert','aadmin\AadminController@do_insert');
Route::any('/aadmin/do_code','aadmin\AadminController@do_code');
Route::any('/aadmin/send_code','aadmin\AadminController@send_code');









Route::get('/admin/add_goods','admin\GoodsController@add_goods');
Route::post('/admin/do_add_goods','admin\GoodsController@do_add_goods');


Route::get('/student/register','StudentController@register');
Route::post('/student/do_register','StudentController@do_register');

Route::get('/student/login','StudentController@login');
Route::post('/student/do_login','StudentController@do_login');
// 浏览学生信息
Route::get('/student/index','StudentController@index');
// 删除学生信息
Route::get('/student/delete','StudentController@delete');
// 添加学生信息
Route::get('/student/add','StudentController@add');
Route::post('/student/save','StudentController@save');
// 修改学生信息
Route::get('/student/update','StudentController@update');
Route::post('/student/updateadd','StudentController@updateadd');

//8月
Route::get('/naccess/token','naccess\NaccessController@token');
Route::get('/naccess/get_info','naccess\NaccessController@get_info');
Route::get('/naccess/get_list','naccess\NaccessController@get_list');
Route::get('/naccess/do_login','naccess\NaccessController@do_login');
Route::get('/naccess/code','naccess\NaccessController@code');
Route::get('/naccess/login','naccess\NaccessController@login');
// 上传

Route::post('/naccess/do_upload','naccess\NaccessController@do_upload');
Route::get('/naccess/source','WechatController@wechat_source'); //素材管理
Route::get('/naccess/upload','naccess\NaccessController@upload'); 

Route::get('/naccess/clear_api','naccess\NaccessController@clear_api'); 


//标签 
Route::get('/naccess/get_label','naccess\NaccessController@get_label');
Route::post('/naccess/do_get_label','naccess\NaccessController@do_get_label');
Route::get('/naccess/biaoqian','naccess\NaccessController@biaoqian');
Route::get('/naccess/naccess_del','naccess\NaccessController@naccess_del');
Route::get('/naccess/update/{name}','naccess\NaccessController@update');
Route::post('/naccess/do_update','naccess\NaccessController@do_update');
Route::get('/naccess/index','naccess\NaccessController@index');
Route::get('/naccess/naccess_user','naccess\NaccessController@naccess_user');
Route::post('/naccess/add_ll','naccess\NaccessController@add_ll');
Route::get('/naccess/naccess_git_list','naccess\NaccessController@naccess_git_list');
Route::get('/naccess/naccess_push','naccess\NaccessController@naccess_push');
Route::get('/naccess/tag_user','naccess\NaccessController@tag_user');
Route::post('/naccess/do_naccess_push','naccess\NaccessController@do_naccess_push');
Route::get('/naccess/jjj','naccess\NaccessController@jjj');

//模板
Route::get('/moban/moban_add','moban\MobanController@moban_add');


//自定义操蛋
Route::get('/menua/index','menua\menuaController@index');
Route::get('/menua/token','menua\menuaController@token');
// 调用中间件
Route::group(['middleware'=>['login']],function(){
    // 添加学生信息
Route::get('/student/add','StudentController@add');
});

    

// 修改中间件
Route::group(['middleware'=>['update']],function(){
    Route::get('/comm/update','CommController@update');
    Route::post('/comm/do_update','CommController@do_update');

});





