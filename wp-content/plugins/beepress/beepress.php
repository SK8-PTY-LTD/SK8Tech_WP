<?php
/*
Plugin Name: BeePress
Plugin URI: http://artizen.me/beepress
Description: 微信公众号文章一键导入
Version: 1.0.1
Author: 黄碧成（Bee）
Author URI: http://artizen.me
License: GPL
*/

/**
 * 初始化
 */
if(!class_exists('simple_html_dom_node')){
	require_once("simple_html_dom.php");
}

$GLOBALS['done'] = false;

add_action('admin_init', 'beepress_admin_init');
add_action('init', 'beepress_process_request');

function beepress_admin_init () {
	// 引入样式文件及交互脚本
	wp_register_style('bootstrap-style', plugins_url('/vender/bootstrap/css/bootstrap.min.css', __FILE__));
	wp_register_script('bootstrap-script', plugins_url('/vender/bootstrap/js/bootstrap.min.js', __FILE__));
}

/**
 * 后台入口
 */
if (is_admin()) {
	add_action('admin_menu', 'beepress_admin_menu');
}
// 在文章下面添加子菜单入口
function beepress_admin_menu() {
	add_menu_page('「BeePress｜蜜蜂采集」，文章一键导入插件', 'BeePress', 'administrator', 'beepress', 'beepress_setting_page', '');
}
// BeePress界面
function beepress_setting_page() {
	require_once 'setting-page.php';
}

// 处理请求
function beepress_process_request() {
	set_time_limit(0);//避免超时
	// 媒体：wx 公众号, js 简书
	$media    = isset($_REQUEST['media']) ? $_REQUEST['media'] : '';
	// 文章url
	$postUrls = isset($_REQUEST['post_urls']) ? $_REQUEST['post_urls'] : '';
	$postFile = isset($_FILES['post_file']) ? $_FILES['post_file'] : '';
	// 两者都没有，则不进行处理
	if (!($postFile || $postUrls)) {
		return;
	}
	// 如果是文件形式，则处理成URL
	if (isset($postFile['tmp_name']) && $postFile['tmp_name']) {
		$postUrls = file_get_contents($postFile['tmp_name']);
	}
	$finalUrls = explode("\n", $postUrls);
	if (count($finalUrls) == 0) {
		return;
	}

	switch($media) {
		// 微信
		case 'wx':
			beepress_for_wx_insert_by_url($finalUrls);
			break;
		// 简书 todo
		case 'js':
			break;
		default:
			// do nothing
			break;
	}
}

function beepress_for_wx_insert_by_url($urls) {
	//添加下载图片地址到本地功能
	$imageDownload  = isset($_REQUEST['image_process_mode']) && $_REQUEST['image_process_mode'] == 'local';
	$sprindboard    = isset($_REQUEST['springboard']) ?
						$_REQUEST['springboard'] :
						'http://read.html5.qq.com/image?src=forum&q=1&r=0&imgflag=3&imageUrl=';
	// 微信原作者
	$changeAuthor   = isset($_REQUEST['change_author']) && $_REQUEST['change_author'] == 'true';
	// 改变发布时间
	$changePostTime = isset($_REQUEST['change_post_time']) && $_REQUEST['change_post_time'] == 'true';
	// 保留来源
	$keepSource     = isset($_REQUEST['keep_source']) && $_REQUEST['keep_source'] == 'keep';
	// 默认是直接发布
	$postStatus     = isset($_REQUEST['post_status']) && in_array($_REQUEST['post_status'], array('publish', 'pending', 'draft')) ?
						$_REQUEST['post_status'] : 'publish';
	// 保留文章样式
	$keepStyle      = isset($_REQUEST['keep_style']) && $_REQUEST['keep_style'] == 'keep';
	// 文章分类，默认是未分类（1）
	$postCate       = isset($_REQUEST['post_cate']) ? intval($_REQUEST['post_cate']) : 1;
	// 过滤不符合规范的URL
	$urls = array_map(function($url) {
		if (strpos($url, 'http://mp.weixin.qq.com/s') !== false || strpos($url, 'https://mp.weixin.qq.com/s') !== false) {
			return trim($url);
		}
		return "";
	}, $urls);

	foreach ($urls as $url) {
		if (!$url) {
			continue;
		}
		$html = @file_get_contents($url);
		if (!$html) {
			continue;
		}
		// 是否移除原文样式
		if (!$keepStyle) {
			$html = preg_replace('/style\=\"[^\"]*\"/', '', $html);
		}
		$dom  = str_get_html($html);
		// 文章标题
		$title   = $dom->find('#activity-name', 0)->plaintext;
		// 确保有标题
		if (!$title) {
			continue;
		}
		// 处理图片及视频资源
		$imageDoms = $dom->find('img');
		$videoDoms = $dom->find('.video_iframe');
		foreach ($imageDoms as $imageDom) {
			$dataSrc = $imageDom->getAttribute('data-src');
			if (!$dataSrc) {
				continue;
			}
			$src  = $sprindboard . $dataSrc;
			$imageDom->setAttribute('src', $src);
		}
		foreach ($videoDoms as $videoDom) {
			$dataSrc = $videoDom->getAttribute('data-src');
			// 视频不用跳板
			$videoDom->setAttribute('src', $dataSrc);
		}
		// 文章内容
		$content = $dom->find('#js_content', 0)->innertext;
		// 发布日期
		if ($changePostTime) {
			$postDate = date('Y-m-d H:i:s', time());
		} else {
			$postDate = $dom->find('#post-date', 0)->plaintext;
			$postDate = date('Y-m-d H:i:s', strtotime($postDate));
		}
		// 提取用户信息
		$url      = parse_url($url);
		$query    = $url['query'];
		$queryArr = explode('&', $query);
		$bizVal   = '';
		foreach ($queryArr as $item) {
			list($key, $val) = explode('=', $item, 3);
			if ($key == '__biz') {
				//  用户唯一标识
				$bizVal = $val;
				break;
			}
		}
		// 如果链接中不含有biz参数，则选择当前的时间戳作为用户名和密码
		if ($bizVal == '') {
			$bizVal = time();
		}

		// 是否改变作者，默认是当前登录作者
		$userName = $dom->find('#post-user', 0)->plaintext;
		$userName = esc_html($userName);
		if ($changeAuthor) {
			// 创建用户
			$userId   = wp_create_user($bizVal, $bizVal);
			// 用户已存在
			if ($userId->get_error_code() == 'existing_user_login') {
				$userData = get_user_by('login', $bizVal);
			} else if(is_integer($userId) > 0) {
				$userData = get_userdata($userId);
			} else {
				// 错误情况
				continue;
			}
			// 默认是投稿者
			$userData->add_role('contributor');
			$userData->remove_role('subscriber');
			$userData->display_name = $userName;
			$userData->nickname     = $userName;
			$userData->first_name   = $userName;
			wp_update_user($userData);
			$userId = $userData->ID;
		} else {
			// 默认博客作者
			$userId = get_current_user_id();
		}

		//保留来源
		if ($keepSource) {
			$source =
					"<blockquote class='keep-source'>" .
						"<p>始发于微信公众号：<a href='{$url}' target='_blank' rel='notfollow'>{$userName}</a></p>" .
						"<p>通过<a href='http://artizen.me/beepress' target='_blank'>「BeePress｜蜜蜂采集」插件生成</a></p>" .
					"</blockquote>";
			$content .= $source;
		}

		$post = array(
			'post_title'    => $title,
			'post_content'  => $content,
			'post_status'   => $postStatus,
			'post_date'     => $postDate,
			'post_modified' => $postDate,
			'post_author'   => $userId,
			'post_category' => array($postCate)
		);
		$postId = wp_insert_post($post);

		// 下载图片到本地
		if (intval($postId) > 0 && $imageDownload) {
			beepress_downloadImage($postId, $dom);
		}
	}
	$GLOBALS['done'] = true;
}

require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once( ABSPATH . 'wp-admin/includes/image.php' );
require_once( ABSPATH . 'wp-admin/includes/media.php' );
require_once( ABSPATH . 'wp-admin/includes/post.php' );

function beepress_downloadImage($postId, $dom) {
	// 提取图片
	$images = $dom->find('img');
	foreach ($images as $image) {
		$src = $image->getAttribute('src');
		$type = $image->getAttribute('data-type');
		if (!$src) {
			continue;
		}
		$tmpFile = download_url($src);
		$fileArr = array(
			'name' => 'beepress-image-' . $postId . '-' . time() .'.' . $type,
			'tmp_name' => $tmpFile
		);

		$id = @media_handle_sideload($fileArr, $postId);
		if (is_wp_error($id)) {
			@unlink($tmpFile);
			continue;
		} else {
			$src = wp_get_attachment_image_url($id, 'full');
			$homeUrl = home_url();
			$src = substr_replace($src, '', 0, strlen($homeUrl));
			$image->setAttribute('src', $src);
		}
	}
	$content = $dom->find('#js_content', 0)->innertext;
	@wp_update_post(array(
		'ID' => $postId,
		'post_content' =>  $content
	));
}
