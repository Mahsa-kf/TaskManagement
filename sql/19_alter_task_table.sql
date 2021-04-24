ALTER TABLE tasks ADD COLUMN due_date DATE;

UPDATE tasks
SET due_date = '2021-04-20';