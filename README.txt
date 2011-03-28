*NO NAME*-FRAMEWORK

FOLDER STRUCTURE

==> application - application specific code
	    ==> assets - application specific js/css/images
==> system - framwork folder
	    ==> config - database/server configuration
	    ==> db - database backups
	    ==> library - framework code
	    ==> tmp - temporary data

CODING CONVENTIONS

1. MySQL tables will always be lowercase and plural e.g. items, cars
2. Models will always be singular and first letter capital (e.g. Item, Car)
3. Controllers will always have “Controller” appended to them (e.g. ItemsController, CarsController)
4. Views will have plural name followed by action name as the file (e.g. items/view.php, cars/buy.php)