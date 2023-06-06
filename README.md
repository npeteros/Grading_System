# Grading System

This repository contains a grading system project.

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)

## Introduction
The Grading System project is designed to automate the process of grading and managing student assessments. It provides a user-friendly interface for teachers to create assignments, evaluate student submissions, and generate grades. This system aims to streamline the grading process and improve efficiency in educational institutions.

## Features
- User-friendly web interface for teachers and administrators
- Assignment creation and management
- Import/export functionality for student data
- Student submission and assessment tracking
### Incoming Features
- Customizable grading criteria
- Detailed grading reports
- Automated grading functionality 
- Grade calculation and report generation

## Installation
To install and run this grading system locally, follow these steps:

1. Clone the repository:

```shell
git clone https://github.com/npeteros/grading_system.git
```

2. Navigate to the project directory:

```shell
cd grading_system
```

3. Configure the database connection in the `includes/mysqli_connect.php` file:

```shell
DB_HOST=your_database_host
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
DB_NAME=your_database_name
```

4. Start the application on your local Apache server.

6. Access the grading system by opening a web browser and visiting `http://localhost/grading_system`.

## Usage
To use the grading system, follow these steps:

1. Import the student data into the system.
2. Set up the grading criteria and associated weights.
3. Run the grading process.
4. View the grading reports and export the results if needed.
