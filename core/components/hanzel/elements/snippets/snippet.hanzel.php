<?php
$tvPrefix = $modx->getOption('tvPrefix', $scriptProperties, "hz.");
$mainCrumbClass =$modx->getOption('mainCrumbClass', $scriptProperties, "");
$firstCrumbClass =$modx->getOption('firstCrumbClass', $scriptProperties, "firstCrumb");
$currentCrumbClass =$modx->getOption('currentCrumbClass', $scriptProperties, "currentCrumb");
$mainCrumbTpl =$modx->getOption('mainCrumbTpl', $scriptProperties, null);
$firstCrumbTpl =$modx->getOption('firstCrumbTpl', $scriptProperties, null);
$currentCrumbTpl =$modx->getOption('currentCrumbTpl', $scriptProperties, null);

$delimiter =$modx->getOption('delimiter', $scriptProperties, '<li>|</li>');

$currentResource = $modx->getOption('currentResource', $scriptProperties, $modx->resource->get('id'));
$siteStart = $modx->getOption('siteStart', $scriptProperties, $modx->getOption('site_start', null, 'default'));

$includeHome = $modx->getOption('includeHome', $scriptProperties, 'true');
$excludeResources = $modx->getOption('excludeResources', $scriptProperties);
$excludeTemplates = $modx->getOption('excludeTemplates', $scriptProperties);

if (isset($excludeResources)){$excludeResources = explode(',', $excludeResources);} 
	else {$excludeResources = Array();}
if (isset($excludeTemplates)){$excludeTemplates = explode(',', $excludeTemplates);} 
	else {$excludeTemplates = Array();}

array_push($excludeResources, '0');
if ($includeHome == 'false'){
	array_push($excludeResources, $siteStart);
}





$parentList = $modx->getParentIds($currentResource);
$parentList = array_reverse($parentList);
array_push($parentList, $currentResource);
$parentList = array_diff($parentList, $excludeResources);

if ($includeHome == 'true' && in_array($siteStart, $parentList) == false){
	array_unshift($parentList, $siteStart);
}




$output = "<ul class=\"breadcrumb\">";

$vars = array();
$vars[$tvPrefix."mainCrumbClass"] = $mainCrumbClass;
$vars[$tvPrefix."firstCrumbClass"] = $firstCrumbClass;
$vars[$tvPrefix."currentCrumbClass"] = $currentCrumbClass;

foreach ($parentList as $parent){

	$object = $modx->getObject('modResource', $parent);
	if (in_array($object->get('template'), $excludeTemplates) == false){
		$vars[$tvPrefix."pagetitle"] = $object->get('pagetitle');
		$vars[$tvPrefix."url"] = $modx->makeUrl($parent, "", "", "full");
		
		if ($parent == reset($parentList)){ //First
			$output .= "<li class=\"".$firstCrumbClass."\"><a href=\"".$vars[$tvPrefix."url"]."\">".$vars[$tvPrefix."pagetitle"]."</a></li>".$delimiter;
		} else if ($parent == $currentResource) { //Current
			$output .= "<li class=\"".$currentCrumbClass."\"><a href=\"".$vars[$tvPrefix."url"]."\">".$vars[$tvPrefix."pagetitle"]."</a></li>";	
		} else { //Default
			$output .= "<li class=\"".$mainCrumbClass."\"><a href=\"".$vars[$tvPrefix."url"]."\">".$vars[$tvPrefix."pagetitle"]."</a></li>".$delimiter;
		}	
	}	
	
}

	//$output .= "<li class=\"currentPage\"><a href=\"".$modx->makeUrl($modx->resource->get('id'), "", "", "full")."\">".$modx->resource->get('pagetitle')."</a></li>";
		
return $output."</ul>";