
CREATE TABLE IF NOT EXISTS tasks ( 
   id INT PRIMARY KEY AUTO_INCREMENT, 
   title varchar(250),
   description varchar(4000), 
   assigned_user_id int,
   project_id int,
   creator_user_id int,  
   priority_id int,
   category_id int,
   state_id int,
   estimated_time decimal,
   spent_time decimal,
   remaining_time decimal,
   created_date timestamp,
   FOREIGN KEY (assigned_user_id)
	REFERENCES app_user(id)
	ON DELETE SET NULL,	
FOREIGN KEY (project_id)
	REFERENCES project(id)
	ON DELETE SET NULL,		
FOREIGN KEY (creator_user_id)
	REFERENCES app_user(id)
	ON DELETE SET null,
FOREIGN KEY (priority_id)
	REFERENCES priority(id)
	ON DELETE SET NULL,	
FOREIGN KEY (category_id)
	REFERENCES category(id)
	ON DELETE SET NULL,	
	FOREIGN KEY (state_id)
	REFERENCES state(id)
	ON DELETE SET NULL
)