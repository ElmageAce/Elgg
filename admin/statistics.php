<?php
/**
 * Elgg administration statistics index
 * This is a special page that displays a number of statistics
 *
 * @package Elgg
 * @subpackage Core
 */

// Get the Elgg framework
require_once(dirname(dirname(__FILE__)) . "/engine/start.php");

// Make sure only valid admin users can see this
admin_gatekeeper();

$notices_html = '';
$notices = elgg_get_admin_notices();
if ($notices) {
	foreach ($notices as $notice) {
		$notices_html .= elgg_view_entity($notice);
	}
	$notices_html = "<div class=\"elgg-admin-notices\">$notices_html</div>";
}

// Display main admin menu
$title = elgg_view_title(elgg_echo('admin:statistics'));
$main_box = elgg_view("admin/statistics");
$content = $notices_html . elgg_view_layout("two_column_left_sidebar", '', $title . $main_box);

page_draw(elgg_echo("admin:statistics"), $content);