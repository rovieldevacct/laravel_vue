###READ ME###

This was created with laravel with vue js for front end and MySql for database.
To start using this, you will need to set up a database preferably PHPMYADMIN as that's the one I used.
Set up the database config in .env file.
run the command php artisan migrate:fresh --seed to use some random data. This will run the creation of the following tables:
1. Users table and other authentication related tables.
2. migrations table
3. products table
4. product category table

This will generate a random data using the faker library.
Users table will generate 30 random users and 2 fixed users which will serve as admin users.
Account details of 2 fixed users is:
1. user: roviel@gmail.com pass: @dmin1234
2. user: roviel2@gmail.com pass: @dmin1234
Those 2 users will have access_control 1 and the rest of the users will have access_control 2.
At the moment there's no configuration of the uses of the access_control column but it is there for access level accounts for future use.
Product Category table will generate 10 random data.
Products table will generate 100 random data.
Per product there will be 1 category_id that will be set using the pluck method to capture random id from the product_category table.
You can see those configs on the factories folder.
Access the project via localhost and select where you want to login or create a user.
###LOGINS###
-Creating a new user uses the email address as the login credentials.
-Login using the newly added user or use the admin accounts
Once logged in, you can see the Products dashboard.

###DASHBOARD###
Design is very simple and I didn't use the adminLTE template as I just want to make this clean and simple.
Fronend uses VUE with vue-router in it so it doesn't reload pages each time you select an action.
In the products table, you can add, edit or delete records.

###ADD NEW###
Clicking add new will show the add new page which you can add new records.
-You can set a product name with a max of 100 characters in the serverside validations.
-Product category can be selected using a dropdown from the product_category table
-Description can have a max of 100 characters as well.
*If by any chance the random data that was generated using the migrations --seed has exceeded 100 characters it is because the faker library that I used
generates random sentences and I didn't include a max limit to it for testing purposes only.
-Clicking save will redirect you to the products listing where it shows the newly added data.

###EDIT###
Clicking the edit button will redirect you to the edit page
-All data will show on the selected record.
-Validation is the same from the add new records which is 100 character limit.
-Clicking save will notify the user that the data is saved but will not redirect to the product listing page for verifications of the data.

###DELETE###
Clicking delete will show a pop-up notification to verify if you want to continue the deletion of data.
-Clicking yes will delete the record.

###NOT INCLUDED###
Search function was not included yet.
Pagination was not included yet.
Sorting of data not included yet.
updating of user data.
change password.


###INCLUDED###
Auth routing was included.
Create, update, delete only.
Registration of new users.

###CLOSING REMARKS###
The project was kind-of a mess actually because of the dependency that was needed in some bits of the program which I gradually keep on adding
resulting some conflicts that's why I got little time to explore and update it. I had a lot of plans in mind but I need to finish this ASAP that's why design is very simple 
and compact.
