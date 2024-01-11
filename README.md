# Movie System

Movie System (codename Wave) is a web application built with Laravel for managing and displaying information about movies.

## Contents

1. [Tables Structure](#tables-structure)
2. [Details about CRUD Operations for the Models](#operations)
3. [Models: Genres, Producers and Movies](#models)
4. [Routes](#routes)
5. [Features](#features)
6. [Usage](#usage)
7. [License](#license)

## Tables Structure
### Users
- Default Laravel Backpack generated table.

### Base
Every table contains these, as they come pre-configured with migrations, they are hidden from the end user.
- **Columns**:
  - id
  - created_at
  - updated_at


### Movies
- **Columns**:
  - image->string('image',255)->nullable();
  - name->string('name')->unique();
  - release_date->date('release_date')->nullable();
  - language->string('language')->after('release_date');
  - status->enum('status', ['Planned', 'In Production', 'Released', 'Cancelled']);
  - score->tinyInteger('score',)->unsigned();
- **Relationship**:
  - One-to-many with Genres (one Movie has many Genres).
  - One-to-many with Producers (one Movie has many Producers).
  - The releationships are established through joining tables that contain the id-s of the respective join.

### Genres
- **Columns**:
  - name->string('name')->unique();
  - description->text('description');
 
### Producers
- **Columns**:
  - name->string('name')->unique();
  - date_of_birth->date('date_of_birth');
  - gender->enum('gender', ['Male', 'Female', "Prefer not to say"]);

## Operations
### MovieController
- **Index**:
  - Displays all movies.
- **Search**:
  - Filters products based on the provided search query. Search for movies by a movie's name, release date, status, genres or producers. Includes filtering against special characters.
- **Show**:
  - Displays the information for a single movie based on the provided ID.

### IndexController
  - The index controller is static, it's methods simply display static views and will be discussed in the Routes section.

## Models
### Movie Model
- **Image Handling**:
  - Logic for image handling.
- **Relationships**:
  - Has many genres.
  - Has many producers.

## Routes
### Index
- `/`: The project's main index page.
- `/about`: Access the about page.

### Movies
- `/movies`: Index page for movies, includes a search bar.
- `/movies/search`: Search categories.


## Features

- **Genre Management**: Full CRUD operations on Genres.
- **Producer Management**: Full CRUD operations on Producers.
- **Movie Management**: Create movies and associate them with existing genres and producers.
- **Custom Validatiion Rules**: Every model has custom route rules set.
- **Search**: Search for movies by the movie's name, release date, status, genres or producers.

## Usage

- **Admin Panel**: Access the admin panel through the Admin Panel tab on the navigation var to manage genres, producers, and movies.
- **Public View**: Visit the main site to search for and view information about movies.

## License

This project is open-source and available under the [MIT License](LICENSE).