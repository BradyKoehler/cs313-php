-- Main database for the program.
CREATE DATABASE textite;

-- Connect to the new database.
\c textite

-- USERS: Website authentication/login.
CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  username VARCHAR(80) NOT NULL,
  email VARCHAR(80) NOT NULL,
  password VARCHAR(120) NOT NULL,
  salt VARCHAR(40) NOT NULL,
  admin BOOLEAN NOT NULL DEFAULT FALSE
);

-- TEXTS: The main content of the site.
CREATE TABLE texts (
  id SERIAL PRIMARY KEY,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  user_id INT NOT NULL REFERENCES users(id),
  name VARCHAR(80) NOT NULL,
  content TEXT NOT NULL,
  views INT NOT NULL DEFAULT 0
);

-- NOTES: Comments on a Text created by a User.
CREATE TABLE notes (
  id SERIAL PRIMARY KEY,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  user_id INT NOT NULL REFERENCES users(id),
  text_id INT NOT NULL REFERENCES texts(id),
  content TEXT NOT NULL
);

-- KEYS: API keys belonging to Users.
CREATE TABLE keys (
  id SERIAL PRIMARY KEY,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  user_id INT NOT NULL REFERENCES users(id),
  data VARCHAR(80) NOT NULL,
  active BOOLEAN NOT NULL DEFAULT TRUE,
  last_use TIMESTAMP NOT NULL
);

-- TAGS: Descriptive labels for Texts.
CREATE TABLE tags (
  id SERIAL PRIMARY KEY,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  name VARCHAR(80) NOT NULL
);

-- Stores records of many-to-many associations between
-- Texts and Tags.
CREATE TABLE tag_associations (
  id SERIAL PRIMARY KEY,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  tag_id INT NOT NULL REFERENCES tags(id),
  text_id INT NOT NULL REFERENCES texts(id)
);

-- This trigger sets the updated_at timestamp on a table row
-- when a record is updated.
CREATE OR REPLACE FUNCTION updated_at_func()
RETURNS TRIGGER AS $$
BEGIN
  NEW.updated_at = NOW();
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

-- This script loops through each of the public tables just
-- created and adds the updated_at trigger to each of them,
-- set to run when a row is updated.
DO $$
DECLARE 
  tables CURSOR FOR
    SELECT tablename
    FROM pg_tables
    WHERE schemaname = 'public';
BEGIN
  FOR table_record IN tables LOOP
    EXECUTE 'CREATE TRIGGER updated_at_trigger BEFORE UPDATE ON ' || table_record.tablename || ' FOR EACH ROW EXECUTE PROCEDURE updated_at_func();';
  END LOOP;
END$$;

-- Insert a new admin user.
INSERT INTO users (username, email, password, salt, admin) VALUES ('bradykoehler', 'bradykoehler@byui.edu', 'myP4$$W0RD', 'salt', true);