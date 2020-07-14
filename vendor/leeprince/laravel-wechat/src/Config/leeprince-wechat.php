<?php

/**
 * leeprince/laravel-wechat composer 组件中的配置文件
 *      是执行命令  php artisan vendor:publish --provider="LeePrince\WeChat\WeChatServiceProvider" 生成的配置文件
 */
return [
    'wechat_template' => [
        // 文本模板
        'text'  => '
            <xml>
              <ToUserName><![CDATA[%s]]></ToUserName>
              <FromUserName><![CDATA[%s]]></FromUserName>
              <CreateTime>%s</CreateTime>
              <MsgType><![CDATA[text]]></MsgType>
              <Content><![CDATA[%s]]></Content>
            </xml>',
        // 图片模板
        'image'  => '
            <xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[image]]></MsgType>
                <Image>
                    <MediaId><![CDATA[%s]]></MediaId>
                </Image>
            </xml>',
        // 图文模板
        'news'  =>[
            'TplHead' => '
                  <xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>%s</ArticleCount>
                    <Articles>',
            'TplBody' => '
                    <item>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                    </item>',
            'TplFoot' => '
                    </Articles>
                  </xml>'
        ],
    ]
];
