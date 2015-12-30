INTRODUCTION
------------
DATE CREATED: July 2015

PROJECT: Offline Transaction Manager Assistant for Blackbird Tutoring, LLC

LANGUAGES EMPLOYED: HTML, CSS, Javascript/JQuery, PHP, MySQL

DESCRIPTION: This is a personal project I created to facilitate the day to day operations of my tutoring service. In the past, I would record all transactions on an excel spreadsheet, but I realized that it became tedious to update information and add similar transactions. 

Features:
* Add transaction feature
* 'Current date' button on transaction form
* Copy button: copy any existing transaction to the form
* Edit button: edit any existing transaction directly in the table
* Color coding: Visually indicates which clients have paid and which haven't (i.e 'red':outstanding, 
'green':paid)
* Paid button: updates database for a given customer to indicate that all transactions have been paid for


HOW TO RUN
-----------
1. On your server, run MySQL in the 'sql' folder and create a new database
2. Once using new DB, use the command: SOURCE sample_db.sql; //This will create appropriate tables and load test data
3. Open config_transactions.php and set server information accordingly 
4. Open transactions.php via host server. 
