#Using hanzel

The minimum snippet call to generate a hanzel breadcrumb:

```
[[hanzel]]

```
This would generate a basic list based Breadcrumb seperated using a delimiter, with classes to destinguish between the first crumb and the crumb of the current page.


 ```html
<ul class="breadcrumb">
	<li class="firstCrumb">Elephant</li>
	<li>|</li>
	<li>Lion</li>
	<li>|</li>
	<li>Bear</li>
	<li>|</li>
	<li class="currentCrumb">Fish</li>
</ul>
 ```


#Parameters


| Name | Type | Default Value | Description |
| ---- | ---- | ------------- | ----------- |
| &outerClass | string | 'breadcrumb' | Class to be applied to the outer container of the breadcrumbs |
| &innerClass | string | '' | Class to be applied to every bread crumb other than the first and current crumbs |
| &firstClass | string | 'firstCrumb' | Class to be applied to the first crumb in the trail |
| &currentClass | string | 'currentCrumb' | Class to be applied to the current crumb in the trail |
| &delimiter | string | '<li>|</li>' | Delimiter to seperate crumbs |
| &includeHome | string | 'true' | Sets whether or not the site_start resource (homepage) should be included |
| &excludeResources | string | '' | Sets a list of Resource ids to ignore when building the breadcrumb trail |
| &excludeTemplates | string | '' | Sets a list of Template ids to ignore when building the breadcrumb trail |

#License

hanzel is under the [GPL](http://www.gnu.org/copyleft/gpl.html) License.