<?php
$resource = $modx->getOption('resource', $scriptProperties, $modx->resource->get('id'));

$includeHome = $modx->getOption('includeHome', $scriptProperties, true);
$siteStart = $modx->getOption('siteStart', $scriptProperties, $modx->getOption('site_start', null, 'default'));


$tvPrefix = $modx->getOption('tvPrefix', $scriptProperties, "hz.");

$parentList = $modx->getParentIds($resource);

if ($includeHome && !in_array($siteStart, $parentList)){
	array_unshift($parentList, $siteStart);
}

$output = "<ul class=\"breadcrumb\">";


foreach ($parentList as $parent){
	if ($parent != 0){
		$vars = array();
		$object = $modx->getObject('modResource', $parent);
		$vars[$tvPrefix."pagetitle"] = $object->get('pagetitle');
		$vars[$tvPrefix."url"] = $modx->makeUrl($parent, "", "", "full");
		$output .= "<li><a href=\"".$vars[$tvPrefix."url"]."\">".$vars[$tvPrefix."pagetitle"]."</a></li>";
	}
}

		$output .= "<li class=\"currentPage\"><a href=\"".$modx->makeUrl($modx->resource->get('id'), "", "", "full")."\">".$modx->resource->get('pagetitle')."</a></li>";

		
return $output."</ul>";