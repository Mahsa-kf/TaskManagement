
DROP TABLE IF EXISTS tasks
DROP TABLE IF EXISTS category

CREATE TABLE category ( 
   id INT PRIMARY KEY AUTO_INCREMENT, 
   title varchar(250),
   description varchar(1000),
   created_date timestamp,
   project_id int,
   creator_user_id int,
FOREIGN KEY (project_id)
	REFERENCES project(id)
	ON DELETE SET NULL,		
FOREIGN KEY (creator_user_id)
	REFERENCES app_user(id)
	ON DELETE SET NULL
)


-- INSERT INTO category 
-- 	(title,description,created_date, project_id, creator_user_id)
-- VALUES
-- 	('Task CRUD ','Implimnet CRUD for task',now(),1,3)