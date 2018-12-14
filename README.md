# ImageWebService
CS 174 Project - Image Web Service

ABOUT US: Mika is an image web service that compiles beautiful photographs and artwork that is contributed by fellow photographers and artists. Customers of Mika may purchase these photographs through Mika credits. If you are an apiring or professional photographer who would like to contribute to the community, you may be a Mika Seller and can upload your photographs. Mika brings together the art community through an easy and minimalistic application.

USER GUIDE: You can view our user guide video here: https://youtu.be/wOKAsOR5QjM

LOCAL CONFIGURATION: If you would like to run Mika on your local machine, you can download our source file. Our application uses the LAMP Stack (Linux, Apache, MySQL, PHP). We would recommend the following steps to ensure a successful installation of our application:

Download our source files from the above GitHub Repository link.
Download XAMPP for your operating system (https://www.apachefriends.org/index.html)
Once you get XAMPP installed, you should now access to the control panel. Make sure that Apache Web Server and MySQL Database are running.
Go to your browser, and type in 'localhost'. You should then be taken to the home page of XAMPP.
Click on phpMyAdmin
Click on User Accounts. The next few steps are really important to set up correctly. Our source code has specific user account and password for security purposes for our database
Click on ‘Add a new user’ towards the bottom of the page. Input in the following information: User name: 'mika' Host name: 'localhost' (remove the % that is already inputted in that field) Password: 'sesame' Make sure to check on ‘Create database with same name and grant all privileges’
Now you created the database needed for Something Simple. Now you can click on 'mika' on the left side panel. There should be no tables yet in the 'mika' database.
The next step is to import the SQL dump. In our GitHub repository, there is a file called 'mika.sql'.
Click ‘Import’, browse to the 'mika.sql' file, and import to the database. Now you should be able to see three tables. You now successfully imported our database.
The next step is to transfer our source files to the correct directory. You will need to navigate through XAMPP until you reach htdocs.
For Mac, it should be Applications/XAMPP/htdocs For Windows, it should be C:\xampp\htdocs
Create a folder called “Mika” in htdocs.
Within that folder, copy over all the source files (including the images folder, all the php files).
Now from your browser, you should be able to navigate to Mika by typing in http://localhost/mika/.
