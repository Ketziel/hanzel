#hanzel

A breadcrumb plugin for ModX.

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


| Name                      | Type                   | Default  Value   | Description                                                                                                                                                             |
| -------------------|-----------------| ----------------|-----------------------------------------------------------------------------------------------------------------|
| mainCrumbClass                     |string                  | ''                       | Class to be applied to every bread crumb other than the first and current crumbs.                                                                                        |

#License

hanzel is under the [GPL](http://www.gnu.org/copyleft/gpl.html) License.