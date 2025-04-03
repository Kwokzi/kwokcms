<?php

/**

 * [KwokCMS] Ver 1.0 (C) 2025: Mr.Kwok
 * FilePath: /database/seeders/SettingsSeeder.php
 * Created Time: 2025-03-06 11:04:12
 * Last Edit Time: 2025-03-08 14:10:57
 * Description: 配置文件填充项
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            //基本设置
            ['key' => 'web_name', 'value' => config(APP_NAME, 'KwokCMS'), 'note' => '网站名称'],
            ['key' => 'web_url', 'value' => config(APP_URL, 'http://localhost'), 'note' => '网站地址'],
            ['key' => 'web_logo', 'value' => '', 'note' => '网站LOGO'],
            ['key' => 'web_icp', 'value' => '', 'note' => 'ICP备案号'],
            ['key' => 'web_mps', 'value' => '', 'note' => '公安备案号'],
            ['key' => 'web_copyright', 'value' => '技术支持：<a class="text-decoration-none" href="http://www.ha18.com" target="_blank">重庆恩祖科技有限公司</a>', 'note' => '版权信息'],
            ['key' => 'web_status', 'value' => '0', 'note' => '网站状态'],
            ['key' => 'web_close', 'value' => '网站维护中，请稍后访问！', 'note' => '网站关闭提示'],
            ['key' => 'web_template', 'value' => 'default', 'note' => '模板风格'],
            ['key' => 'web_make_date', 'value' => date('Y-m-d H:i:s'), 'note' => '创建时间'],
            //SEO 配置
            ['key' => 'seo_title', 'value' => config(APP_NAME, 'KwokCMS'), 'note' => '网站首页标题'],
            ['key' => 'seo_keywords', 'value' => config(APP_NAME, 'KwokCMS'), 'note' => '网站首页关键词'],
            ['key' => 'seo_description', 'value' => config(APP_NAME, 'KwokCMS'), 'note' => '网站首页描述'],
            ['key' => 'seo_title_append', 'value' => config(APP_NAME, 'KwokCMS'), 'note' => 'Title 后缀'],
            //联系方式
            ['key' => 'web_contacts', 'value' => '', 'note' => '联系人'],
            ['key' => 'web_qq', 'value' => '', 'note' => '客服QQ'],
            ['key' => 'web_wechat', 'value' => '', 'note' => '客服微信'],
            ['key' => 'web_email', 'value' => '', 'note' => '客服邮箱'],
            ['key' => 'web_tel', 'value' => '', 'note' => '客服电话'],
            ['key' => 'web_address', 'value' => '', 'note' => '联系地址'],
            //附件上传
            ['key' => 'upload_limit_size', 'value' => '52428800', 'note' => '限制上传大小'],
            ['key' => 'upload_file_types', 'value' => '.jpg,.jpeg,.png,.gif,.pdf,.xsl,.doc,.xlsx,.docx,.ppt,.pptx,.txt,.md', 'note' => '可上传文件类型'],
            ['key' => 'attachment_path', 'value' => 'public', 'note' => '附件保存路径'],
            ['key' => 'attachment_url', 'value' => '', 'note' => '附件访问路径'],
            //缩略图
            ['key' => 'image_thumb_open', 'value' => '1', 'note' => '是否生成缩略图'],
            ['key' => 'image_thumb_width', 'value' => '200', 'note' => '缩略图宽度'],
            ['key' => 'image_thumb_height', 'value' => '200', 'note' => '缩略图高度'],
            //图片水印
            ['key' => 'image_watermark_open', 'value' => '1', 'note' => '图片水印开关'],
            ['key' => 'image_watermark_type', 'value' => '1', 'note' => '水印类型'],
            ['key' => 'image_watermark_text', 'value' => '', 'note' => '水印文字'],
            ['key' => 'image_watermark_position', 'value' => '9', 'note' => '水印位置'],
            ['key' => 'image_watermark_text_font', 'value' => 'public/fonts/simhei.ttf', 'note' => '水印文字字体'],
            ['key' => 'image_watermark_size', 'value' => '16', 'note' => '水印文字大小'],
            ['key' => 'image_watermark_color', 'value' => '#000000', 'note' => '水印文字颜色'],
            ['key' => 'image_watermark_opacity', 'value' => '80', 'note' => '水印透明度'],
            ['key' => 'image_watermark_img', 'value' => '', 'note' => '水印图片'],
            ['key' => 'image_watermark_img_position', 'value' => '9', 'note' => '水印图片位置'],
            ['key' => 'image_watermark_img_opacity', 'value' => '80', 'note' => '水印图片透明度'],
            //图片压缩
            ['key' => 'image_compress_open', 'value' => '1', 'note' => '图片压缩开关'],
            ['key' => 'image_compress_quality', 'value' => '80', 'note' => '图片压缩质量'],
            ['key' => 'image_compress_width', 'value' => '800', 'note' => '图片最大宽度'],
            ['key' => 'image_compress_height', 'value' => '800', 'note' => '图片最大高度'],
            //验证码开关
            ['key' => 'captcha_open', 'value' => '1', 'note' => '验证码开关'],
            ['key' => 'captcha_type', 'value' => '1', 'note' => '验证码类型'],
            ['key' => 'captcha_length', 'value' => '4', 'note' => '验证码长度'],
            ['key' => 'captcha_width', 'value' => '100', 'note' => '验证码宽度'],
            ['key' => 'captcha_height', 'value' => '36', 'note' => '验证码高度'],
            ['key' => 'captcha_font_size', 'value' => '16', 'note' => '验证码字体大小'],
            //分页显示数
            ['key' => 'page_perpage', 'value' => '10', 'note' => '分页显示数'],
            ['key' => 'page_max_pagenum', 'value' => '100', 'note' => '最大分页数'],
            //用户注册
            ['key' => 'register_open', 'value' => '1', 'note' => '注册开关'],
            ['key' => 'register_rules', 'value' => '1', 'note' => '注册协议'],
            ['key' => 'register_check', 'value' => '1', 'note' => '注册审核'],
            ['key' => 'register_interval', 'value' => '60', 'note' => '注册间隔'],
            ['key' => 'register_length', 'value' => '200', 'note' => '注册字数'],
            //用户登录
            ['key' => 'login_open', 'value' => '1', 'note' => '登录开关'],
            ['key' => 'login_interval', 'value' => '60', 'note' => '登录间隔'],
            //评论设置
            ['key' => 'comment_open', 'value' => '1', 'note' => '评论开关'],
            ['key' => 'comment_check', 'value' => '1', 'note' => '评论审核'],
            ['key' => 'comment_interval', 'value' => '60', 'note' => '评论间隔'],
            ['key' => 'comment_length', 'value' => '200', 'note' => '评论字数'],
            //其它配置
            ['key' => 'user_agent', 'value' => '', 'note' => '客户端伪装'],
            ['key' => 'time_zone', 'value' => '8', 'note' => '时区'],
            ['key' => 'html_compress', 'value' => '0', 'note' => 'HTML 压缩'],
        ];

        DB::table('settings')->insert($settings);
    }
}
