# php_restapi1


progress 1: 

 - Make requests to IMBD Open Api - server ( movies data )
   http://www.omdbapi.com/

 - Remember aslo get your own apikey for IMBD Open Api :
   http://www.omdbapi.com/apikey.aspx


- Make request to  OpenLibrary - server ( book data ) 
  https://openlibrary.org/

_________________________________________________________

progress 2:

 - Patch previous task to use JWT-token authorization. You can't go directly getBook.php and getMovie.php to view
data directly. This data can be displayed only via Client.php using JWT-authorization.

- Client.php use now pure php-code and previous client code is now Client.html, because ajax not work as need with php - fronted , I will focus more in php version of client.
Both client can do JWT-authorization and /getBook and /getMovie rest-api dnon't work directly without client. Client send unique information to server and get JWT-token.

- You can check generateJWTtoken.php file and see how it works. Server save client unique jwt-token to text-file. After than client send JWT-token back to server to verify than he is right user. 
Please note that some parts of JWT-token library is not my and followed from tutorial code. See info in preinstallation guide.

_________________________________________________________

progress 3:

- Create PHP visual front-end. View client in structured and user friendly way ( hide json-data ) using php code ( without javascript ).
 
- Create global variables file "MyConfigurationData.php" wich shares same varriables with project like "absolute path" or "domain url"

- Some small reference to OOP design.

_________________________________________________________

progress 4:

- fixed drop-down menu and solved annoying bug, now it is more user friendly and remember selected book when you change movie

- solved url/rest-api link now insted of /getMovie.php you can call /getMovie without "php" file extension.   See .htaccess file

- jwt-token now have expired check, user can see error message about jwt-token is expired.

- modified JwtHandler.php file ( not my ) for supporting jwt-expired date handle

_________________________________________________________

progress 5:

- update front-end and make more relevant design, replace css-inline to css-file. 

- split project to subfolders ( "front" is front-end materials and "config" folder contains my configuration-class)

- following OOP - pattern ( more logic required in future )

_______________________________________________________

progress x :

 - Php OOP design, make more classes and more clear code. Focus on program architecture and remove not relevan code from previos progress
 
 - replace deviceId to unique connection link from server. Each client have their own unique connection link 
   ( server side random generated uuid number )
 
_________________________________________________________

raw materials :

Collect some links and code-parts, can be "low quality code" at this folder, benefit purpose only

_________________________________________________________

PREINSTALLATION & SYSTEM REQUIREMENTS


install appache2 to ubuntu:

```$ sudo apt-get install apache2```

install php to apache2:

```$ sudo apt-get install apache2 php libapache2-mod-php```

this allow run php-scripts at localhosts just put html and php files to 
/var/www/html folder wich is default "linux public" folder at apache web server

use command : 
```$ sudo cp getBook.php /var/www/html/progress5``` 
( from project folder assume you are in your /home folder )

JWT-TOKEN GUIDE :

For JWT-library follow this tutorial : 
https://www.w3jar.com/how-to-implement-the-jwt-with-php/

Copy github https://github.com/firebase/php-jwt source to your apache folder ( /var/www/html/progress5 ) and "JwtHandle.php"  to generate JWT-token for user.

Remember also add permission for file uuid-string-1.txt like this : :

```$ sudo chmod 777 /var/www/html/progress5/uuid-string-1.txt``` 

because php save user jwt-token on server side for verification

.HTACCESS GUIDE:

modify "apache2.conf" file : change paraneter AllowOverride from "None" to "All" at "/var/www" :

```$sudo gedit /etc/apache/apache2.conf```

This allow you set configuration based on your project. Our purpose is set php route to remove php dot extension. Old extension still works, but you are allowed use both solution

create file .htaccess to your server directory "var/www/html/progress5" to view this file use "ls -la" command because dot-files are invisible files in linux.

write route data to .htaccess


_________________________________________________________






 