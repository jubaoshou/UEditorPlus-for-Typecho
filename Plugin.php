<?php

namespace TypechoPlugin\UEditorPlus;

use Typecho\Plugin\PluginInterface;
use Typecho\Widget\Helper\Form;
use Typecho\Widget\Helper\Form\Element\Text;
use Widget\Options;

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}
/**
 * UEditor Plus是基于百度UEditor二开的所见即所得富文本编辑器。
 *
 * @package UEditorPlus for Typecho
 * @author jubaoshou
 * @version 4.1.0
 * @link https://github.com/jubaoshou/UEditorPlus-for-Typecho
 * Date: 2024-10-30
 */
class Plugin implements PluginInterface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        \Typecho\Plugin::factory('admin/write-post.php')->richEditor = __CLASS__ . '::render';
        \Typecho\Plugin::factory('admin/write-page.php')->richEditor = __CLASS__ . '::render';
        
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Form $form) {}
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Form $form) {}
    
    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function render()
    {
        $js = \Typecho\Common::url('UEditorPlus/ueditor.config.js', Options::alloc()->pluginUrl);
        $js1 = \Typecho\Common::url('UEditorPlus/ueditor.all.js', Options::alloc()->pluginUrl);
        $js2 = \Typecho\Common::url('UEditorPlus/lang/zh-cn/zh-cn.js', Options::alloc()->pluginUrl);

        echo '<script type="text/javascript" src="'. $js. '"></script><script type="text/javascript" src="'. $js1. '"></script><script type="text/javascript" src="'. $js2. '"></script>';
        echo '<script type="text/javascript">
    //初始化编辑器
    $(document).ready(function (e) {
        var ue = UE.getEditor("text",{
            maximumWords:30000
        });
    });
    // 保存草稿时同步
    document.getElementById("btn-save").onclick = function() {
        ue.sync("text");
    }
    // 提交时同步
    document.getElementById("btn-submit").onclick = function() {
        ue.sync("text");
    }
    </script>';
    }
}
