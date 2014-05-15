<?php
$tvPrefix = $modx->getOption('tvPrefix', $scriptProperties, "hz.");
$mainCrumbClass =$modx->getOption('mainCrumbClass', $scriptProperties, "");
$firstCrumbClass =$modx->getOption('firstCrumbClass', $scriptProperties, "firstCrumb");
$currentCrumbClass =$modx->getOption('currentCrumbClass', $scriptProperties, "currentCrumb");
$mainCrumbTpl =$modx->getOption('mainCrumbTpl', $scriptProperties, null);
$firstCrumbTpl =$modx->getOption('firstCrumbTpl', $scriptProperties, null);
$currentCrumbTpl =$modx->getOption('currentCrumbTpl', $scriptProperties, null);

$resource = $modx->getOption('resource', $scriptProperties, $modx->resource->get('id'));
$includeHome = $modx->getOption('includeHome', $scriptProperties, true);
$siteStart = $modx->getOption('siteStart', $scriptProperties, $modx->getOption('site_start', null, 'default'));

$parentList = $modx->getParentIds($resource);
array_push($parentList, $resource);

if ($includeHome && !in_array($siteStart, $parentList)){
	array_unshift($parentList, $siteStart);
}

$output = "<ul class=\"breadcrumb\">";

$vars = array();
$vars[$tvPrefix."mainCrumbClass"] = $mainCrumbClass;
$vars[$tvPrefix."firstCrumbClass"] = $firstCrumbClass;
$vars[$tvPrefix."currentCrumbClass"] = $currentCrumbClass;

foreach ($parentList as $parent){
	if ($parent != 0){
		$object = $modx->getObject('modResource', $parent);
		$vars[$tvPrefix."pagetitle"] = $object->get('pagetitle');
		$vars[$tvPrefix."url"] = $modx->makeUrl($parent, "", "", "full");
		
		if ($parent == reset($parentList)){ //First
			$output .= "<li class=\"".$firstCrumbClass."\"><a href=\"".$vars[$tvPrefix."url"]."\">".$vars[$tvPrefix."pagetitle"]."</a></li>";
		} else if ($parent == $resource) { //Current
			$output .= "<li class=\"".$currentCrumbClass."\"><a href=\"".$vars[$tvPrefix."url"]."\">".$vars[$tvPrefix."pagetitle"]."</a></li>";	
		} else { //Default
			$output .= "<li class=\"".$mainCrumbClass."\"><a href=\"".$vars[$tvPrefix."url"]."\">".$vars[$tvPrefix."pagetitle"]."</a></li>";
		}
		
	}
}

	//$output .= "<li class=\"currentPage\"><a href=\"".$modx->makeUrl($modx->resource->get('id'), "", "", "full")."\">".$modx->resource->get('pagetitle')."</a></li>";
		
return $output."</ul>";