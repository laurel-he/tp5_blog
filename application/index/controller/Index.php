<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
class Index extends Controller
{
    public function index(Request $request)
    {
        $user_session = $request->session('user_name');
        if($user_session)
        {
            $login = "欢迎您".$user_session;
        }
        else
        {
            $login = "请先登陆";
        }
        $cont = Db::name('blog')->select();
        $this->assign('content',$cont);
        $hot_rank = Db::name('blog')->order('praise desc')->limit('3')->select();
        $time_rank = Db::name('blog')->order('blog_time desc')->limit('3')->select();
        $this->assign('hot_rank',$hot_rank);
        $this->assign('login',$login);
        $this->assign('time_rank',$time_rank);
        return $this->fetch();
    }
}
