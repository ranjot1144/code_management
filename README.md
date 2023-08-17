This project provides an API for Code Management wit unique, allocated and reset functionalities.

Installation
1. Clone the repository
git clone https://github.com/your-username/code-management.git
2. Navigate to project directory
3. Run the migrations to create the necessary tables
php artisan migrate
4. Execute the program.
In my case the URL is
http://localhost/code_management/public/api/generate-code

Usage
The API provide the following points
1. api/generate-code
    Generate a unique code and save into database.
2. api/allocate-code
    Mention Key(Column Name) and Value
    Update the status of allocated code to unallocated code randomly.
3. api/reset-allocated-code
    Mention Key(Column Name) and Value
    Reset allocated code to unallocated.

Testing

To run tests, execute the following command
    php artisan test/ vendor\bin\phpunit --filter CodeControllerTest
