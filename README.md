
## Project Name: Task Management System
##  By Team C4M 
## Team Members
1. Choo 
2. Gordian
3. Mihoko
4. Mahsa

### Project Description: 
 
Team C4M proposes a task management system to help teams of people coordinate their efforts when working together on a group project. Users can sign up for accounts, create new teams and join existing teams. A team can create projects which are broken down into discrete tasks or objectives. These tasks and objects will be assigned to members of the team to work on. Once a task has been completed, the member responsible for it can mark it as such on the system for the other members to see.
 
Our system will track deadlines and notify members of upcoming due dates. Our system will also have messaging and document exchange features for team members to communicate with each other and transfer information to other members.


## Design & Tools
- [x] Boostrap 
- [x] CSS
- [x] PHP
- [x] Javascript
- [x] Composer,Packagist(phpmailer)

## Features

### CRUD 1: Project CRUD (Choo)

#### Description
- User can create a new project with information including, project name, start date and description. Users allow to edit the project information as well as delete the project. 

#### Learning Curve
- Struggling to retrieved and update project timestamp from database

#### Overcome
- Data type for project timestamp retrieved data and update data have to be the same format : "2021-03-01 10:41:06"

#### What's Next
- Improve usability interface 

---
### CRUD 1: Member CRUD (Choo)

#### Description
- User can add member on created project from the registered user list with designated role added too. Users allow to edit the edit the role of the member and remove member from the selected project. 

#### Learning Curve
- Some variables do not carry the value and having issue on validation
- Duplicate insert of same member to the list
- Not able to display error message on its box 

#### Overcome
- Since it is on client render part,use JavaScript to keep track on which value is selected before submission. 
- Set user’s id and project’s id [Both are foreign key] as primary key and unique, then use INSERT …. DUPLICATE UPDATE ON query.

#### What's Next
- Try to improve my functions that render the update and add table on same page. 
- Try to fix the position of the error message box from update to add section.

---

### GORDIAN MOK'S CONTRIBUTION

#### Features

- User-specific notifications (/Model/Notifications.php)
- Upcoming due dates report for each user (/Model/UpcomingDueDates.php)
- Task Progress bar display for each task (/Model/TaskProgress.php)
- Emailer feature using PHPMailer (/Model/Emailer.php)
- Header (/views/partials/header.php)
- Footer (/views/partials/footer.php)
- Sidebar (/views/partials/header.php) [superceded]

#### Description
- Notifications displays in the sidebar the number of tasks that are past due or will become due in the next 7 days
- Upcoming Due Dates feature displays in the sidebar the tasks that will be due in the near future, the title, and due dates
- Task Progress creates a progress bar to display the progress of the project in visual form by calculating the tasks that have been marked as Done or Cancelled and comparing that with the number of overall tasks outstanding in the project
- Emailer is a class method to support other features by sending emailed notices or confirmations to users
- Header, Footer and Sidebar are functions that generate dynamic HTML content for the header, footer and sidebar

#### Learning Curve
- Learning curve for this project was medium

#### Overcome
- SQL datetime data and PHP datatime data type are not entirely compatible and so techniques were researched to convert SQL datetime data into a form that is recognized by PHP
- SQL queries were designed to efficiently obtain the needed data and filter out data that is not required, thereby reducing the data processing workload required in PHP
- Research into HTML and Bootstrap progress bar element was educational

#### What's Next
- Styling improvements 
- Expand the functionality of the Notification and Upcoming Due Dates features to display more useful information to the user

---

### MIHOKO SCHICK'S CONTRIBUTION

#### Features

- Sign up and Login (views/login.php, views/signup.php/ Model/Authentication.php)
- Contact Us Page (views/contactus.php, /Model/Contact.php)
- FAQ Page (views/faq.php, views/searchResults.php, /Model/FAQ.php)
- Login User Dropdown on Header (/views/partials/header.php)

#### Description
- Sign up: User input name (first and last name), email address and password, and  confirm password, validate inputs.Password field encrypts using “password_hash”. If there are no validation errors, these information will be stored in the database. Once the user creates the account, automatically login and move to the task management page. Use sessions. 
- Login: User input email address and password, and validate the inputs. If email address and password match to the data stored in the database, the user can login and move to the task management page. Use session, so that the user does not need to login again if the user closes the browser and comes back to the dashboard again.
- Contact Us page form contains inputs for the name, email, phone number, dropdown for inquiry type, and text area for message. Name, email, inquiry dropdown and message area have validation and phone number field is optional. If there is no validation error, the confirmation page will display with information user inputed. If the user clicks the ''send' button, the form information will be stored in the database(contact_info_public). “Thank you message” will be displayed and the button will be disabled.
- FAQ: Main FAQ page has three categories:“Getting Started”, “Dashboard”, “Troubleshooting” . Once a user clicks a button, the page will redirect to the Search Results page. Questions and answers for the categories will be retrieved from the database.Main FAQ page and search result page have a search bar so that the user can use a search bar to look for certain questions, the system will use keywords to try to find an equivalent question in the system.

#### Learning Curve
- Learning curve for this project was medium

#### Overcome
- Database connection using PDO
- Familiarized with PHP build-in function
- Heroku deployment and clearDB

#### What's Next
- I would like to try ajax for forms and search bar next time


### Mahsa Karimi Fard'S CONTRIBUTION

#### Features (Mahsa)
- First: Category or Backlog(CRUD):
    - views/category-add.php                  
    - views/category-list.php, 
    - views/category-delete.php                  
    - views/category-update.php
    - Model/Category.php
    - Applied Validations to forms   


- Second: Task(CRUD) feature:
    - views/task-add.php                  
    - views/task-delete.php                  
    - views/task-update.php
    - Model/task.php
    - Applied Validations to forms


- Third: Task Board (Filtering)
    - views/task-board.php 
    - Filtering (options to filter tasks by Assigned To which member/ By Backlog Items(related tasks)/ By State(Done-In progress-To Do and canceled))
    - Assigned To- Dropdown (Model/member.php)
    - Backlog item- Dropdown 
    - State- Dropdown (Model/State.php)
    - Reset Filters 
    - Apply Filters

 #### Description for Category or Backlog Items (CRUD)
- In category list or Backlog Items you are able to see the list of backlog items. A project backlog is a list of the new features, changes to existing features, bug fixes or other activities that a team may deliver in order to achieve a specific outcome. Each backlog item may have several tasks.
    User can delete backlog item in list page.
#### Description for Task CRUD:
-  From the task-board page, the user can see the list of tasks which by clicking on the details button that it will navigate to update and delete pages. For creating a new task, user clicks on the button and it will navigate to the task-add page. there are two buttons in this page save and cancel that by clicking on boat they will back to task-board page.
#### Description For Task-Board Filtering:
- Filtering: There are tree dropdowns options to filter task list:
  -	Assigned To: Only display tasks which assigned to a specific person
  -	Backlog Item: Only display tasks related to a Backlog Item
  -	State: display task with specific state (Done, In progress, To Do or canceled)

Two buttons which represents the Reset Filters when user doesn’t want to apply any filters by clicking on this button it will back to previous or original list of tasks. And Apply filters, user can apply filtering by any of these 3 dropdowns or even all together.


#### Learning Curve
- Learning curve for this project was medium
