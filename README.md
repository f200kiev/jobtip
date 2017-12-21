jobtip
======

This is test tast for JobTip company writted on Symfony 3.3

Requirements:

`` php >= 7.0.0 ``

`` php sqlite extension``

`` composer ``

How to start:

1) Download application from github repository

``git clone https://github.com/f200kiev/jobtip.git``

2) Goto project folder and run composer

``composer install``

3) Start local server (console message return you server link - example http://127.0.0.1:8000/)

``bin/console server:start``

4) Goto server link and start testing the application


Structure
=======
Data is stored on sqlite in file /var/data/data.sqlite

There is one Main Controller that handle all requests to render proper data.

Using ORM I have created 2 entities Companies and Positions with proper structure according to requirements.
Thanks to ORM you are able to work with the proper Entity Objects with all needed relations, that helps in development process a lot.

There are form for adding company and adding positions with all fields validation.

There are persisters that handle all data saving to database.

Templates are here (app/Resources/views)

User interface is very simple and not styled very good, as this is not the main focus of the task.

Phase 2 (Future steps)
======
This is out of scope, but my next steps can be:
1) Add functionality to edit vacant position, edit company name.
2) Add functionality to delete entities.
With ORM Doctrine this can be simply implemented.
3) Add good design from some markups.
4) Add Api to be able to use frontend frameworks in this project.

That's pritty it.