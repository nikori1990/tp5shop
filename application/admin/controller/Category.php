<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Category extends Controller
{
    public function index()
    {
        $category_list = Db::name('goods_category')->where('status',1)->select();
        $category_tree = list_to_tree($category_list);

        $this->assign('category_tree', $category_tree);

        return $this->fetch('category/index');
    }

    public function tree($tree = null)
    {
        $this->assign('tree', $tree);
        return $this->fetch('tree');
    }

    public function add($pid = null)
    {
        return $this->fetch('add');
    }

}
