INSERT INTO tasks ( 
	   title,
	   description, 
	   assigned_user_id,
	   project_id,
	   creator_user_id,  
	   priority_id,
	   category_id,
	   state_id,
	   estimated_time,
	   spent_time,
	   remaining_time,
	   created_date
   ) values (
   		'Create task form',
   		'Desgin a form for Edit and Update tasks',
   		(select id from app_user LIMIT 1),
   		(select id from project LIMIT 1),
   		(select id from app_user LIMIT 1),
   		(select id from priority LIMIT 1),
      (select id from category LIMIT 1),
      (select id from state LIMIT 1),
      2,
      3,
      1,
      NOW()
   )
   
   
INSERT INTO tasks ( 
	   title,
	   description, 
	   assigned_user_id,
	   project_id,
	   creator_user_id,  
	   priority_id,
	   category_id,
	   state_id,
	   estimated_time,
	   spent_time,
	   remaining_time,
	   created_date
   ) values (
   		'Create category form',
   		'Desgin a form for Edit and Update categiries',
   		(select id from app_user LIMIT 1),
   		(select id from project LIMIT 1),
   		(select id from app_user LIMIT 1),
   		(select id from priority LIMIT 1),
		(select id from category LIMIT 1),
		(select id from state LIMIT 1),
		2,
		3,
		1,
		NOW()
   )
   