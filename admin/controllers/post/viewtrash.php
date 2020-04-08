<?php
permission_user();
require_once('admin/models/posts.php');

$title = 'Thùng rác';
if (isset($_GET['page'])) $page = intval($_GET['page']);
else $page = 1;

$page = ($page > 0) ? $page : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

$options = array(
    'where' => 'post_type =1 and post_status="Trash"',
    'limit' => $limit,
    'offset' => $offset,
    'order_by' => 'id DESC'
);
$posts  = get_all('posts', $options);

$url = 'admin.php?controller=post&action=viewtrash';
$total_rows = get_total('posts', $options);
$total = ceil($total_rows / $limit);

$pagination = pagination_admin($url, $page, $total);
require('admin/views/post/viewtrash.php');
