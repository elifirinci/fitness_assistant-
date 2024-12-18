# Fitness Website

A personalized fitness platform designed to inspire and support your health journey. This project offers features tailored to individual users, including workout music playlists, healthy recipes, motivational quotes, BMI calculation, and more.

## Features

- **Workout Music Playlists**: Curated music collections to keep you energized during workouts.
- **Healthy Recipes**: Explore a variety of healthy recipes to complement your fitness routine.
- **Motivational Quotes**: Get inspired with quotes to keep your fitness goals on track.
- **BMI Calculator**: Calculate your Body Mass Index to better understand your health status.
- **User Accounts**: Personalized user experience with secure login and signup functionality.
- **Comment Section**: Users can engage with articles and share their thoughts, with their usernames displayed alongside their comments.

## Technologies Used

- **HTML**: For structuring the web pages.
- **CSS**: For styling and designing the website.
- **JavaScript**: For interactive elements and client-side functionalities.
- **PHP**: For server-side processing, user authentication, and database interactions.
- **MySQL**: For database management.

## How to Run

1. Clone the repository to your local machine:
   ```bash
   git clone https://github.com/yourusername/fitness-website.git
   ```

2. Set up a local server environment (e.g., XAMPP, WAMP, or LAMP).

3. Move the project folder to your server's root directory (e.g., `htdocs` for XAMPP).

4. Import the database:
   - Open phpMyAdmin.
   - Create a new database (e.g., `fitness_website`).
   - Import the provided SQL file (`database.sql`) into the new database.

5. Update the database connection settings in `config.php`:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "fitness_website";
   ```

6. Start your server and navigate to `http://localhost/fitness-website` in your browser.


## Contribution

Contributions are welcome! Feel free to fork this repository, make your changes, and submit a pull request.

## Contact

For any questions or suggestions, please contact ffelif3439@gmail.com

