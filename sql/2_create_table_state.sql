CREATE TABLE IF NOT EXISTS STATE ( 
    ID INT PRIMARY KEY AUTO_INCREMENT, 
    description varchar(100) 
)

INSERT INTO state 
	(description)
VALUES 
	('To Do'),
	('In Progress'),
	('Done'),
	('Canceled')
