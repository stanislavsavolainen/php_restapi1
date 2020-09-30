# php_restapi1






progress 1: 

Make requests to IMBD Open Api - server ( movies data )
http://www.omdbapi.com/

Remember aslo get your own apikey for IMBD Open Api :
http://www.omdbapi.com/apikey.aspx


Make request to  OpenLibrary - server ( movies data ) 
https://openlibrary.org/

progress 2:
Patch previous task to use JWT-token authorization. You can't go directly getBook.php and getMovie.php to view
data directly. This data can be displayed only via Client.php using JWT-token.


progress 3:
Php OOP design, make classes and more clear code. Focus on program architecture and remove not relevan code from previos progress



raw materials :

Collect some links and code-parts, can be "low quality codee" at this folder, benefit purpose only



PREINSTALLATION & SYSTEM REQUIREMENTS

install appache2 to ubuntu:

$ sudo apt-get install apache2

install php to apache2:

$ sudo apt-get install apache2 php libapache2-mod-php

this allow run php-scripts at localhosts just put html and php files to 
/var/www/html folder wich is default "linux public" folder at apache web server

use command : 
$ sudo cp getBook.php /var/www/html/ ( from project folder assume you are in your /home folder )



 