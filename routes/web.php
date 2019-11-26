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

Route::any('/', function () {
    return view('welcome');
});


// Route::any('index','admin\AdminController@index');

//课程模板
Route::prefix('/class')->group(function(){
    route::any('class_cate_add','class1\ClassController@class_cate_add');//添加课程分类
    route::any('class_cate_add_do','class1\ClassController@class_cate_add_do');//添加课程分类执行
});
//后台登录
Route::any('login', 'admin\LoginController@index')->name('admin.login.white');
Route::any('loginPost', 'admin\LoginController@login')->name('admin.login.post.white');
Route::any('logout', 'admin\LoginController@logout')->name('admin.logout.white');
Route::any('person', 'admin\LoginController@person')->name('admin.person.black');  //个人中心

Route::middleware(['menu'])->group(function(){
    //用户
    Route::any('user/login','User\UserController@login');//登录
    Route::any('user/login_do','User\UserController@login_do');//登录
    Route::any('user/useradd','User\UserController@useradd');//视图
    Route::any('user/seluser','User\UserController@seluser');//邮箱验证
    Route::any('user/userdoadd','User\UserController@userdoadd');//添加
    Route::any('user/userlist','User\UserController@userlist')->name('用户列表展示');//列表
    Route::any('user/usercollect','User\UserController@usercollect');//用户收藏
    Route::any('user/userorder','User\UserController@userorder');//用户收藏
    Route::any('user/useron','User\UserController@useron');//禁用启用
});

//项目主体内容，各大模块
Route::middleware(['login','menu'])->group(function(){
    Route::any('person', 'admin\LoginController@person')->name('admin.person.black');
    Route::prefix('/adminRight')->group(function(){
        Route::get('/permission', 'admin\PermissionController@index')->name('权限列表展示'); //权限列表视图
        Route::get('/permission/create', 'admin\PermissionController@create')->name('权限添加视图'); //权限添加视图
        Route::post('/permission/store', 'admin\PermissionController@store')->name('权限添加执行'); //权限添加执行
        Route::get('/permission/edit', 'admin\PermissionController@edit')->name('权限修改视图'); //权限修改视图
        Route::post('/permission/update', 'admin\PermissionController@update')->name('权限修改执行'); //权限修改执行
        Route::post('/permission/delete', 'admin\PermissionController@delete')->name('权限删除'); //权限删除

        Route::any('/roles', 'admin\RolesController@index')->name('角色列表展示'); //角色展示
        Route::any('/roles/create', 'admin\RolesController@create')->name('角色添加视图'); //角色添加视图
        Route::any('/roles/store', 'admin\RolesController@store')->name('角色添加执行'); //角色添加执行
        Route::any('/roles/edit', 'admin\RolesController@edit')->name('角色修改视图'); //角色修改视图
        Route::any('/roles/update', 'admin\RolesController@update')->name('角色修改执行'); //角色修改执行
        Route::any('/roles/delete', 'admin\RolesController@delete')->name('角色删除'); //角色删除

        Route::any('/user', 'admin\UserController@index')->name('管理员列表展示'); //管理员列表视图
        Route::any('/user/create', 'admin\UserController@create')->name('管理员添加视图'); //管理员添加视图
        Route::any('/user/store', 'admin\UserController@store')->name('管理员添加执行'); //管理员添加执行
        Route::any('/user/status', 'admin\UserController@status')->name('管理员状态'); //管理员状态
        Route::any('/user/edit', 'admin\UserController@edit')->name('管理员修改视图'); //管理员修改视图
        Route::any('/user/update', 'admin\UserController@update')->name('管理员修改执行'); //管理员修改执行
        Route::any('/user/reset', 'admin\UserController@reset')->name('管理员重置密码'); //管理员重置密码

        Route::any('/menu', 'admin\MenuController@index')->name('菜单列表展示'); //菜单列表视图
        Route::any('/menu/create', 'admin\MenuController@create')->name('菜单添加视图'); //菜单添加视图
        Route::any('/menu/store', 'admin\MenuController@store')->name('菜单添加执行'); //菜单添加执行
        Route::any('/menu/edit', 'admin\MenuController@edit')->name('菜单修改视图'); //菜单修改视图
        Route::any('/menu/update', 'admin\MenuController@update')->name('菜单修改执行'); //菜单修改执行
        Route::any('/menu/delete', 'admin\MenuController@delete')->name('菜单删除'); //菜单删除

        Route::any('/index', function () {
            return view('admin/index');
        });
    });
    Route::prefix('/course')->group(function(){
        //笔记
        Route::any('/note', 'course\NoteController@index')->name('笔记列表展示'); //笔记列表展示
        Route::any('/note/create', 'course\NoteController@create')->name('笔记添加视图'); //笔记添加视图
        Route::any('/note/store', 'course\NoteController@store')->name('笔记添加执行'); //笔记添加执行
        Route::any('/note/del', 'course\NoteController@del')->name('笔记删除'); //笔记删除
        //课程分类
        Route::any('cate','course\CategoryController@catelist')->name('课程分类列表展示');//课程分类列表
        Route::any('cate/add','course\CategoryController@add')->name('课程分类添加');//课程分类添加
        Route::any('cate/category','course\CategoryController@category')->name('课程分类添加渲染视图');//课程分类添加渲染视图
        Route::any('cate/catedel','course\CategoryController@catedel')->name('课程分类删除');//课程分类删除
        Route::any('cate/cateedit','course\CategoryController@cateedit')->name('课程分类修改');//课程分类修改
        Route::any('cate/cateupdate','course\CategoryController@cateupdate')->name('课程分类执行修改');//课程分类执行修改
        //课程
        Route::any('course','course\courseController@courselist')->name('课程列表展示');//课程列表
        Route::any('course/courseadd','course\courseController@courseadd')->name('课程添加');//课程添加
        Route::any('course/coursecreate','course\courseController@course')->name('课程添加渲染视图');//课程添加渲染视图
        Route::any('course/coursedel','course\courseController@coursedel')->name('课程删除');//课程删除
        Route::any('course/courseedit','course\courseController@courseedit')->name('课程修改');//课程修改
        Route::any('course/courseupdate','course\courseController@courseupdate')->name('课程修改');//课程修改
        //章节
        Route::any('part','course\PartController@partlist')->name('章节列表展示');//章节列表
        Route::any('part/part','course\PartController@part')->name('章节添加渲染视图');//章节添加渲染视图
        Route::any('part/partadd','course\PartController@partadd')->name('章节添加');//章节添加
        Route::any('part/partdel','course\PartController@partdel')->name('章节删除');//章节删除
        Route::any('part/partedit','course\PartController@partedit')->name('章节修改');//章节修改
        Route::any('part/partupdate','course\PartController@partupdate')->name('章节修改');//章节修改

        //作业管理
        Route::any('/job', 'course\JobController@jobindex')->name('作业列表展示'); //作业列表视图
        Route::any('/job/create', 'course\JobController@jobcreate')->name('作业添加视图'); //作业添加视图
        Route::any('/job/store', 'course\JobController@jobsave')->name('作业添加执行'); //作业添加执行
        Route::any('/job/delete', 'course\JobController@jobdelete')->name('作业删除'); //作业删除
        Route::any('/job/change', 'course\JobController@jobchange')->name('作业下拉框更改'); //作业下拉框更改
        Route::any('/job/edit', 'course\JobController@jobupdate')->name('作业修改视图'); //作业修改视图
        Route::any('/job/update', 'course\JobController@jobdoupdate')->name('作业修改执行'); //作业修改执行
    });

    // 讲师模板
    Route::prefix('/teacher')->group(function(){
        route::any('teacher','Teacher\TeacherController@teacher_list')->name('讲师列表展示');//讲师列表展示
        route::any('teacher/create','Teacher\TeacherController@teacher_add_index')->name('添加讲师视图');//添加讲师视图
        route::any('teacher/store','Teacher\TeacherController@teacher_add')->name('添加讲师执行');//添加讲师执行
        route::any('teacher/delete','Teacher\TeacherController@delete')->name('讲师删除');//讲师删除
        route::any('teacher/edit','Teacher\TeacherController@edit_index')->name('讲师修改视图');//讲师修改视图
        route::any('teacher/update','Teacher\TeacherController@update_do')->name('讲师修改执行');//讲师修改执行
        route::any('check_image_type','Teacher\TeacherController@check_image_type'); //图片转换格式
        route::any('teacher/profit','Teacher\TeacherController@profit_teacher_list')->name('讲师收益展示');//讲师收益展示
    });

    route::any('teacher_examine','Teacher\TeacherController@teacher_examine')->name('讲师审核展示');//讲师审核展示
    route::any('teacher_examine_do','Teacher\TeacherController@teacher_examine_do')->name('讲师审核通过');//讲师审核通过
    route::any('teacher_examine_del','Teacher\TeacherController@teacher_examine_del')->name('讲师审核拒绝');//讲师审核拒绝
    //问答模块
    Route::prefix('/quesres')->group(function(){
        route::any('question/create','Questions\QuestionsController@create')->name('问题添加视图');//问题添加视图
        route::any('question','Questions\QuestionsController@list')->name('问题列表展示');//问题列表展示
        route::any('question/store','Questions\QuestionsController@add')->name('问题添加接口');//问题添加接口
        route::any('question/delete','Questions\QuestionsController@delete')->name('删除问题');//删除问题
        route::any('response','Questions\QuestionsController@response_list')->name('问题答复列表展示');//问题答复列表
        route::any('response/create','Questions\QuestionsController@response')->name('问题答复视图');//问题答复视图
        route::any('response/store','Questions\QuestionsController@response_do')->name('问题答复执行');//问题答复执行
        route::any('response/delete','Questions\QuestionsController@response_del')->name('答复问题删除');//答复问题删除
        route::any('response/edit','Questions\QuestionsController@response_edit')->name('答复问题修改视图');//答复问题修改视图
        route::any('response/update','Questions\QuestionsController@response_save')->name('答复问题修改执行');//答复问题修改执行
    });

    // 课程评论
    Route::prefix('/evaluate')->group(function(){
        route::any('course','Evaluate\EvaluateController@course_evaluate_list')->name('课程评价列表展示');//课程评价列表展示
        route::any('course/store','Evaluate\EvaluateController@course_evaluate_add')->name('课程评价添加接口');//课程评价添加接口
        route::any('course/delete','Evaluate\EvaluateController@course_evaluate_del')->name('课程评价删除');//课程评价删除
    });

    Route::prefix('/ltem')->group(function(){
        Route::any('index_add','course\LtemController@index_add')->name('题库题型视图');
        Route::any('bank_add','course\LtemController@bank_add')->name('题库题型添加执行');
        Route::any('warm_add','course\LtemController@warm_add')->name('题库判断执行');
        Route::any('lt_radio','course\LtemController@lt_radio')->name('题库单选视图');
        Route::any('lt_warm','course\LtemController@lt_warm')->name('题库判断');
        Route::any('lt_danger','course\LtemController@lt_danger')->name('题库多选视图');
        Route::any('danger_add','course\LtemController@danger_add')->name('题库多选添加执行');
        Route::any('ltem_list','course\LtemController@ltem_list')->name('题库列表展示');
        Route::any('lt_del','course\LtemController@lt_del')->name('题库删除');
        Route::any('lt_upd','course\LtemController@lt_upd')->name('题库修改');
    });

    //**************************资讯增删改查***********************************************
    //咨询添加
    Route::post('/InformationController/informationadd','information\InformationController@informationadd')->name('资讯添加');
    //资讯展示
    Route::any('/InformationController/informationshow','information\InformationController@informationshow')->name('资讯列表展示');
    //资讯修改视图
    Route::any('/InformationController/informationupdate_view/{information_id}','information\InformationController@informationupdate_view')->name('资讯修改视图');
    //资讯修改
    Route::post('/InformationController/informationupdate','information\InformationController@informationupdate')->name('资讯修改执行');
    //资讯删除
    Route::any('/InformationController/informationdel/{information_id}','information\InformationController@informationdel')->name('资讯删除');
    //咨询添加视图
    Route::get('/informationadd_view', function () {
        return view('information/add');
    })->name('咨询添加视图');
  
    //*********************************考试增删改查******************************************

    //考试添加页面
    Route::get('/ExamController/exam_add_view','information\ExamController@exam_add_view')->name('考试添加页面');
    //考试指导展示页面
    Route::get('/ExamController/exam_show','information\ExamController@exam_show')->name('考试列表展示');
    //考试修改页面
    Route::get('/ExamController/exam_update_view/{exam_id}','information\ExamController@exam_update_view')->name('考试修改页面');
    //考试添加接口
    Route::post('/ExamController/examadd','information\ExamController@examadd')->name('考试添加接口');
    //考试修改接口
    Route::post('/ExamController/examupdate','information\ExamController@examupdate')->name('考试修改接口');
    //考试删除接口
    Route::any('/ExamController/examdel/{exam_id}','information\ExamController@examdel')->name('考试删除接口');
    //**********************************活动增删改查********************************************
    //活动添加页面
    Route::get('/ActivityController/activity_add_view','information\ActivityController@activity_add_view')->name('活动添加页面');
    //活动展示页面
    Route::get('/ActivityController/activity_show','information\ActivityController@activity_show')->name('活动列表展示');
    //活动修改页面
    Route::get('/ActivityController/activity_update_view/{activity_id}','information\ActivityController@activity_update_view')->name('活动修改页面');
    //活动添加接口
    Route::post('/ActivityController/activityadd','information\ActivityController@activityadd')->name('活动添加接口');
    //活动修改接口
    Route::post('/ActivityController/activityupdate','information\ActivityController@activityupdate')->name('活动修改接口');
    //活动删除接口
    Route::any('/ActivityController/activitydel/{activity_id}','information\ActivityController@activitydel')->name('活动删除接口');
    //**********************************课程收藏、收藏夹************************************
    //**************************************************************************************

    //++++++++++++++++++++++++[收藏夹增删改查]++++
    //生成收藏夹的视图  
    Route::get('/CollectController/create_favorite_view_1/{user_id}/{course_id}','course\CollectController@create_favorite_view_1')->name('已有收藏夹新建收藏夹');
    //已有收藏夹新建收藏夹视图
    Route::get('/CollectController/create_favorite_view/{course_id}/{user_id}','course\CollectController@create_favorite_view')->name('生成收藏夹的视图');
    //生成收藏夹
    Route::post('/CollectController/create_favorite/','course\CollectController@create_favorite')->name('生成收藏夹');
    //展示视图兼接口
    Route::get('/CollectController/favorite_list','course\CollectController@favorite_list')->name('收藏夹列表展示');
    //收藏夹修改视图
    Route::get('/CollectController/favorite_update_view/{favorite_id}','course\CollectController@favorite_update_view')->name('收藏夹修改视图');
    //执行修改收藏夹
    Route::post('/CollectController/favoriteupdate','course\CollectController@favoriteupdate')->name('执行修改收藏夹');
    //执行删除
    Route::get('/CollectController/favoritedel/{favorite_id}','course\CollectController@favoritedel')->name('收藏夹删除');

    //+++++++++++++++++++++++【收藏表的增删改查】+++++++++++
    //生成收藏
    Route::any('/CollectController/create_collect','course\CollectController@create_collect')->name('生成收藏');
    //生成收藏的视图
    Route::any('/CollectController/create_collect_view/{course_id}/{user_id}','course\CollectController@create_collect_view')->name('生成收藏的视图');
    //收藏表 展示 搜索分页——无bug
    Route::get('/CollectController/collect_list','course\CollectController@collect_list')->name('收藏列表展示');
    //收藏表修改页面
    Route::get('/CollectController/collect_update_view/{collect_id}','course\CollectController@collect_update_view')->name('收藏表修改页面');
    //收藏执行修改
    Route::post('/CollectController/collectupdate','course\CollectController@collectupdate')->name('收藏执行修改');
    //收藏执行删除
    Route::get('/CollectController/collectdel/{collect_id}/{u_id}','course\CollectController@collectdel')->name('收藏执行删除');




    //************************************课程公告************************************
    //********************************************************************************
    //创建公告视图
    Route::get('/NoticeController/create_notice_view','course\NoticeController@create_notice_view')->name('创建公告视图');
    //公告列表页面
    Route::get('/NoticeController/notice_show_view','course\NoticeController@notice_show_view')->name('公告列表展示');
    //公告修改页面
    Route::get('/NoticeController/notice_update_view/{notice_id}','course\NoticeController@notice_update_view')->name('公告修改页面');
    //创建公告
    Route::post('/NoticeController/create_notice','course\NoticeController@create_notice')->name('创建公告');
    //公告修改接口
    Route::post('/NoticeController/noticeupdate','course\NoticeController@noticeupdate')->name('公告修改接口');
    //公告删除接口
    Route::get('/NoticeController/noticedel/{notice_id}','course\NoticeController@noticedel')->name('公告删除接口');

    // 轮播图
    Route::prefix('/images')->group(function(){
        route::any('images_add','Images\ImagesController@images_add')->name('轮播图添加视图');
        route::any('images_add_do','Images\ImagesController@images_add_do')->name('轮播图添加执行');
        route::any('check_image_type','Images\ImagesController@check_image_type')->name('检测图片类型');
        route::any('images_list','Images\ImagesController@images_list')->name('轮播图列表展示');
        route::any('images_del','Images\ImagesController@images_del')->name('轮播图删除');
        route::any('images_edit','Images\ImagesController@images_edit')->name('轮播图修改视图');
        route::any('images_save','Images\ImagesController@images_save')->name('轮播图修改执行');
    });

    // 导航
    Route::prefix('/naviga')->group(function(){
        route::any('naviga_add','navigation\navigationController@naviga_add')->name('导航添加视图');
        route::any('naviga_add_do','navigation\navigationController@naviga_add_do')->name('导航添加执行');
        route::any('naviga_list','navigation\navigationController@naviga_list')->name('导航列表展示');
        route::any('naviga_del','navigation\navigationController@naviga_del')->name('导航删除');
        route::any('naviga_edit','navigation\navigationController@naviga_edit')->name('导航修改视图');
        route::any('naviga_edit_do','navigation\navigationController@naviga_edit_do')->name('导航修改执行');
    });

    //*************************************订单管理**********************************
    //******************************************************************************************
    //订单增加页面
    Route::get('/OrderController/create_order_view','order\OrderController@create_order_view')->name('订单增加页面');
    //订单增加
    Route::post('/OrderController/create_order','order\OrderController@create_order')->name('订单增加执行');
    //订单展示
    Route::get('/OrderController/order_show','order\OrderController@order_show')->name('订单列表展示');
    //订单删除
    Route::get('/OrderController/orderdel/{order_id}','order\OrderController@orderdel')->name('订单删除');
    //添加订单详情视图
    Route::get('/OrderController/create_detail_view','order\OrderController@create_detail_view')->name('添加订单详情视图');
    //添加订单详情
    Route::post('/OrderController/create_detail','order\OrderController@create_detail')->name('添加订单详情执行');
    //订单详情展示
    Route::get('/OrderController/detail_show/{order_id}/{u_id}','order\OrderController@detail_show')->name('订单详情展示');
    //订单详情修改页面
    Route::get('/OrderController/detail_update_view/{detail_id}','order\OrderController@detail_update_view')->name('订单详情修改页面');
    //订单详情修改
    Route::post('/OrderController/detail_update','order\OrderController@detail_update')->name('订单详情修改');
    //订单详情中查看用户详情
    Route::get('/OrderController/select_user_detail/{detail_id}','order\OrderController@select_user_detail')->name('订单详情中查看用户详情');
    //订单详情中查看讲师详情
    Route::get('/OrderController/select_teacher_detail/{detail_id}','order\OrderController@select_teacher_detail')->name('订单详情中查看讲师详情');
    //订单详情中查看课程详情
    Route::get('/OrderController/select_course_detail/{detail_id}','order\OrderController@select_course_detail')->name('订单详情中查看课程详情');
    //添加订单执行
    Route::any('/OrderController/create_order_and_detail','order\OrderController@create_order_and_detail');
    //订单选择支付类型
    Route::any('/OrderController/order_pay','order\OrderController@order_pay');

});