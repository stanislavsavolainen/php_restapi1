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

- fix cookie init on page first time ( when browser is opened )

- cookies are disabled and deviceId ( cookie) is not initialized, also inform user , if this happen

- add Client2.php ( no stable ) - version of client for movie custom search 

- To save your time here is example ( rules for check is simple -> if space use  underline "_" and fist character is uppercase )  


``` 
       Title : Game_of_thrones, Years : 2011 to 2019 , but empty at 2018
       Title : Vikings, Year : 2012 to 2016 , 2018 to 2020
       Title : Terminator , Year : 1984, 1992, 1993, 2003, 2008
       Title : Batman , Year : 1989, 1992, 2015 , 2008, 2012  
       Title : Home_alone , Year : 1990, 1992, 1997 

``` 
Please note that all movies by title not means TV-series or continue old saga. For more detailed info
check  ```www.omdabi.com``` as mentioned above. There is no automatic tools added to IMBD rest-api, so you should 
discover manually exsisting content and collect list about it. 

- For "plot"-parameter I din't find some exceptional by search as I did with title and year mix. Please note that you 
can't search only by year, title always required or "s"-parameter 

_______________________________________________________


progress 6:

- split project to subfolders : add "restapi" folder for backend stuff

- deviceId is not hardcoded anymore, server generate connection link. Create automatically text-file (uuid string as filename) for each device to store jwt-token

- add my server private network ip-addess for configuration to use my program remotely on other computer


_______________________________________________________

progress 7:

- add MongoDB ( database ) to project : now deviceIds and jwt-tokens are stored in database instead of text-files

- remove text-files and all references to it 


_________________________________________________________

google_cloud :

- run my current project at google cloud compute engine ( visible in internet )

- fast preinstallation from zero ( check google_cloud_cli.txt ) 

- google-cloud version don't use .htaccess ( following action need to be done with Client.php and Client2.php) : modify all rest-api link refer directly to php file like this:

```
 /getMovie?title= to /restapi/getMovie.php?title=
 /getBook?isbn=  to /restapi/getBook.php?isbn=
 /getJWT?deviceId= to /restapi/generateJWTtoken.php?deviceId=
 /getLink to /restapi/getUniqueConnectionLink.php
 
```

- also make sure that google-cloud firewall allow you use port 80 with ip-addess 0.0.0.0/0  ( I will describe info about it in future )
_________________________________________________________

progress x :

 - Php OOP design, make more classes and more clear code. Focus on program architecture and remove not relevan code from previos progress
 

 - handle TV - series and show url with next/previous/all seasons
 
_________________________________________________________

raw materials :

Collect some links and code-parts, can be "low quality code" at this folder, benefit purpose only

_________________________________________________________

PREINSTALLATION & SYSTEM REQUIREMENTS


install appache2 to ubuntu:

```$ sudo apt-get install apache2```

install php to apache2:

```$ sudo apt-get install apache2 php libapache2-mod-php```

This allow run php-scripts at localhosts. Just put html and php files to 
/var/www/html folder wich is default "linux public" folder at apache web server

use command : 
```$ sudo cp getBook.php /var/www/html/progress5``` 
( from project folder assume you are in your /home folder )

JWT-TOKEN GUIDE :

For JWT-library follow this tutorial : 
https://www.w3jar.com/how-to-implement-the-jwt-with-php/

Copy github https://github.com/firebase/php-jwt source to your apache folder ( /var/www/html/progress5 ) and "JwtHandle.php"  to generate JWT-token for user.

Remember also add permission for file uuid-string-1.txt like this : 

```$ sudo chmod 777 /var/www/html/progress5/uuid-string-1.txt``` 

because php save user jwt-token on server side for verification

.HTACCESS GUIDE:

modify "apache2.conf" file : change parameter AllowOverride from "None" to "All" at "/var/www" :

```$sudo gedit /etc/apache/apache2.conf```

This allow you set configuration based on your project. Our purpose is set php route to remove php dot extension. Old extension still works, but you are allowed use both solution

create file .htaccess to your server directory "var/www/html/progress5" to view this file use "ls -la" command, because dot-files are invisible in linux.

write route data to .htaccess


_________________________________________________________






 