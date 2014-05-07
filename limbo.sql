# This file creates and populates the Limbo database.
# Author: Kevin Callahan and Nicholas Russell
#Version 3.0

#Creates limbo database.
CREATE database IF NOT EXISTS limbo_db ;
USE limbo_db;

#Creates table users.
DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
user_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_name TEXT NOT NULL ,
pass TEXT NOT NULL
);

#Inserts data into users.
INSERT INTO users (user_name, pass)
VALUES ("admin", sha1("gaze11e"));

#Creates table stuff.
DROP TABLE IF EXISTS stuff;
CREATE TABLE IF NOT EXISTS stuff (
  id  INT PRIMARY KEY AUTO_INCREMENT ,
  item_name TEXT NOT NULL, 
  description  TEXT,
  create_date DATETIME DEFAULT NOW(),
  update_date DATETIME DEFAULT NOW(),
  location_id INT NOT NULL,
  room TEXT,
  contact_name TEXT,
  email TEXT,
  phone_number TEXT, 
  status SET("found", "lost", "claimed") NOT NULL
 ) ;


#Creates table locations.
DROP TABLE IF EXISTS locations;
CREATE TABLE IF NOT EXISTS locations (
id INT PRIMARY KEY AUTO_INCREMENT,
create_date DATETIME DEFAULT NOW(),
update_date DATETIME DEFAULT NOW(),
name TEXT NOT NULL,
location_type SET ("Building", "Residence Hall", "Other") NOT NULL
);


#Inserts data into locations.
INSERT INTO locations (name, location_type)
VALUES 
(  "Champagnat", "Residence Hall"),
(  "Leo", "Residence Hall"), 
(  "Sheahan", "Residence Hall"), 
(  "Marian", "Residence Hall"), 
(  "Gartland", "Residence Hall"), 
(  "Midrise", "Residence Hall"), 
(  "Upper West Cedar", "Residence Hall"), 
(  "Lower West Cedar", "Residence Hall"), 
(  "Talmadge Court", "Residence Hall"), 
(  "Upper New Townhouses", "Residence Hall"), 
(  "Lower New Townhouses", "Residence Hall"), 
(  "Lower Fulton", "Residence Hall"),
(  "Upper Fulton", "Residence Hall"),
(  "Middle Fulton", "Residence Hall"),
(  "Tennis Courts", "Other"),
(  "Foy Townhouses", "Residence Hall"), 
(  "Greystone", "Building"), 
(  "Tenney Stadium", "Other"), 
(  "St. Anne's", "Other"), 
(  "Cornell Boathouse", "Other"),
(  "Marist Boathouse", "Other"), 
(  "Student Center", "Building"), 
(  "Music Building", "Building"), 
(  "Jazzman's Cafe", "Building"), 
(  "Main Cafeteria", "Building"),
(  "McCann", "Building"), 
(  "Donnelly", "Building"), 
(  "Dyson", "Building"), 
(  "Fontaine", "Building"), 
(  "Fontaine Annex", "Building"),
(  "Lowell Thomas", "Building"), 
(  "Library", "Building"), 
(  "Hancock", "Building"), 
(  "Steel Plant", "Building"); 

















