# Mezikka

**Description**  
Mezikka is a web application designed to support independent artists by providing a platform to upload and showcase their music. Built TypeScript for a dynamic, responsive front-end experience, and PHP for the back-end API. This project aims to provide a Spotify-like service for artists outside the mainstream music industry.

## Features
- Artist and listener user roles with specific permissions.
- Clean UI/UX with modern design principles using TailwindCSS.
- Admins can use Dashboard to accept newly created users and apply CRUD opperations.
- Bug free front-end built using Typescript for preventing errors.
- Dynamic display without refreshing the page by consuming api requests.

## Getting Started

### Prerequisities
- **XAMPP/Laragon**: a local PHP server environment to run the application(or any Apache server).
- **PostgreSQL**: A database system to manage data (any SQL database would do fine but you'd have to modify the SQL script that is located in the ./sql folder).

### Installation Setup
- You can skip step 2 and 3 if you don't want to create the database manually.

1. **Clone the repositroy**
```bash
git clone https://github.com/Youcode-Classe-E-2024-2025/TAHA-JAITI-MANAGER.git

cd TAHA-JAITI-MANAGER
```
Do npm install to install the dependencies
```bash
npm install
```
2. **Set up the database**
- Open pgAdmin or your PostgreSQL client terminal.
- Execute the SQL script in the /sql/database.sql file.
- The script will create the database and the necessary tables with fake data/

3. **Configure the database connection**
- Navigate to includes/db.php
- Update the connection details:
```php
$host = 'localhost';  
$port = '5432';  
$dbname = 'package_manager'; // Database name 
$user = 'user';  //your database user
$password = 'password';  //your database password
```
4. **Start the PHP server**
- Place the project inside the htdocs directory of your XAMPP installation (or wwww in Laragon).
- Start the Apache from the XAMPP or Laragon control panel.
5. **Acess the application**
- Open your browser and go to *http://localhost/TAHA-JAITI-MANAGER*


### License
- This project is open source!
