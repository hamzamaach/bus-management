# Bus Routes Management System

This project is a bus routes management system built with Laravel. It allows users to view bus routes, see the list of passengers for each route, and add new passengers. The system prioritizes "staff" passengers, displaying them first in the list, and handles form submissions with AJAX.

## Features

- Display bus routes with time, start and end points, and available slots.
- View a list of passengers for each route, sorted with "staff" members first.
- Add new passengers via a modal form.
- Display success and error messages using Toastr notifications.
- Hide the form to add new passengers when no slots are left.
- Reload the page upon successful passenger addition.

## Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/hamzamaach/bus-management.git
    cd bus-management
    ```

2. **Install dependencies:**
    ```sh
    composer install
    npm install
    ```

3. **Set up the environment:**
    Copy the `.env.example` file to `.env` and configure your database and other environment settings.
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

4. **Run migrations and seed the database (if applicable):**
    ```sh
    php artisan migrate --seed
    ```


5. **Start the server:**
    ```sh
    php artisan serve
    ```

## Usage

### Viewing Routes

On the main page, all bus routes are displayed with their time, start and end points, and the number of available slots.

### Viewing Passengers

Clicking on a route opens a modal displaying a table of passengers for that route. "Staff" members are highlighted and displayed first, with a label "Reserved by the staff".

### Adding Passengers

Inside the modal, there is a form to add new passengers. If no slots are left, the form is hidden. Upon submission, an AJAX request is sent to add the passenger. Success and error messages are displayed using Toastr notifications. The page reloads upon successful addition of a passenger.

### Backend Logic

The backend is implemented in Laravel, with routes and controllers handling the business logic:

- **RouteController@index**: Fetches routes and passengers, prioritizes "staff" passengers, and calculates available slots.
- **RouteController@store**: Handles the addition of new passengers and returns success or error messages.

## File Structure

- **app/Http/Controllers/RouteController.php**: Handles route-related logic.
- **resources/views/index/main.blade.php**: Main view template displaying routes and the passenger modal.
- **public/css/app.css**: Custom CSS.
- **public/js/app.js**: Custom JavaScript handling AJAX and Toastr notifications.

## Dependencies

- Laravel
- jQuery
- Bootstrap
- Font Awesome
- Toastr

## Acknowledgements

- [Laravel](https://laravel.com/)
- [jQuery](https://jquery.com/)
- [Bootstrap](https://getbootstrap.com/)
- [Toastr](https://github.com/CodeSeven/toastr)

## Contributing

Contributions are welcome! Please open an issue or submit a pull request.

## Contact

For questions or feedback, please contact [hamzamaach56@gmail.com].
