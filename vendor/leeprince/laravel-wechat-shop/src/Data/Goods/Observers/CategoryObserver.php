<?php

namespace LeePrince\LaravelWechatShop\Data\Goods\Observers;

use LeePrince\LaravelWechatShop\Data\Goods\Models\Category;

class CategoryObserver
{
    // 均是在动作发生之后执行的
    public function created(Category $category)
    {
        dd('created');
    }

    // 这是在Category创建的时候执行
    public function creating(Category $category)
    {
        return false;
        // dd('creating');
        //如果创建的是一个根类目
        // if(is_null($category->pid) || $category->pid == 0){
        //     //将层级设为0
        //     $category->level=0;
        //     //将path设为-
        //     $category->path = '-';
        // }else{
        //     //将层级设为父类目的层级+1
        //     $category->level = $category->parent->level+1;
        //     //将path值设为父类目的path 追加父类目ID以及最后跟上一个-分隔符
        //     $category->path =$category->parent->path.$category->parent_id.'-';
        // }
    }

    /**
     * 修改前会执行的事件
     *  save() 该方法更新前事件正常触发
     *  where(...)->update(...)该方法更新前事件未正常触发
     *      定位：Illuminate\Database\Eloquent\Concerns\HasEvents::observe();
     *      所有注册的事件绑定：Illuminate\Events\Dispatcher 中的 $listeners属性
     *      查找并执行：Illuminate\Database\Eloquent\Concerns\HasEvents::fireModelEvent();
     *      批量新增的问题： 1. 修改源码【简单】； 2：引用其他插件
     */
    public function updating(Category $category)
    {
        // dd('updating');
    }

    public function updated(Category $category)
    {
        dd('updated');
    }

    public function deleted(Category $category)
    {
        dd('deleted');
    }

    public function restored(Category $category)
    {
        dd('restored');
    }

    public function forceDeleted(Category $category)
    {
        dd('forceDeleted');
    }
}
