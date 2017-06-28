<?php


function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0) {
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId =  $data[$pid];
            // 是根目录，向tree数组中添加该分类
            if ($root == $parentId) {
                $tree[] =& $list[$key]; //将当前分类添加到根目录
            }else{
                if (isset($refer[$parentId])) {   //除了父级分类是根目录
                    $parent =& $refer[$parentId];   //根据当前分类的pid指定父级分类
                    $parent[$child][] =& $list[$key];  //将当前分类添加到父级分类
                }
            }
        }
    }
    return $tree;
}
