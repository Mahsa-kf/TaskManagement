
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


## Project Phase 2 Interface Design 

- [x] Mihoko - Login/Signup, Contact Us, FAQ
- [x] Gordian - Landing, Sidebar, header, footer, Upcoming Due Dates, Progress Bar, Notification
- [x] Choo - Project CRUD, Email
- [x] Mahsa - Task CRUD, Category CRUD
- [x] All members are responsible to review any changes and updates on Git
- [x] Design tool : Boostrap and CSS
- [x] Create README.md

## "Features"

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
