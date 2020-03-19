<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * [【多对多关联模型】- belongsToMany]
     *
     * @Author  leeprince:2020-02-20 02:57
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getRoles()
    {
        // 第二个参数是：连接表(连接user表和role表)的表名, 即中间表;;
        // 第三个参数是：中间表与当前表关联的外键;;
        // 第四个参数是：中间表与关联表关联的外键;;
        // 第五个参数是：当前表与中间表关联的外键;;
        // 第六个参数是：关联表与中间表关联的外键;;
        // 当前表：当前 User 模型的表；；关联表：Role模型的表；中间表：指定的 role_user 表
        // return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id', 'id', 'id');

        // 获取中间表字段 - 获取中间表字段 withPivot
        // return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id', 'id', 'id')
        //     ->withPivot('created_at');

        // 自定义 pivot 属性名称
        // return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id', 'id', 'id')
        //     ->as('t3');

        // 通过中间表过滤关系
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id', 'id', 'id')
            ->wherePivot('id', '<', 10);

    }

    /**
     * [定义访问器]
     *
     * @Author  leeprince:2020-02-20 02:59
     * @param $value
     * @return string
     */
    public function getEmailAttribute($value)
    {
        return '访问器：'.ucfirst($value);
    }

    /**
     * [定义访问器]
     *
     * @Author  leeprince:2020-02-20 02:59
     * @param $value
     * @return string
     */
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucfirst($value).'-'.time();
    }
}
