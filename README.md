# 👨‍💼 Employee Management System

A full-stack Employee Management module built with Laravel and Blade, designed as part of an internal HR system.

## 🚀 Features

- Full CRUD for employees
- Real-time form validation
- Soft delete and restore support
- Search and filter by name, status, and hired date
- RESTful API with resources
- Laravel validation via Form Requests
- Database seeding and eager loading
- Responsive UI using Bootstrap and Blade

---

## 🧰 Tech Stack

- *Backend:* Laravel 12
- *Frontend:* Blade + Axios 
- *Database:* MySQL 
- *API Testing:* Postman
- *Seeding:* Faker
- *Dev Tools:* Laravel Artisan, Eloquent ORM

---

## ⚙ Setup Instructions

### 1. Clone the repository

git clone https://github.com/mohamed101ibrahim/HR_Task.git  
cd HR_Task

### 2. Install dependencies

composer install  

### 3. Setup environment file

cp .env.example .env  
php artisan key:generate

### 4. Configure .env

Update your .env with your database credentials:

DB_DATABASE=your_database  
DB_USERNAME=your_username  
DB_PASSWORD=your_password

### 5. Run migrations and seeders

php artisan db:seed

This will create the employees table and seed it with 10,000 fake records.
This will create the departments table and seed it with 30 fake records.

### 6. Serve the app

php artisan serve

App runs at: http://127.0.0.1:8000

---

## 📬 API Endpoints

| Method | Endpoint                    | Description                |
|--------|-----------------------------|----------------------------|
| GET    | /api/employees              | List employees             |
| GET    | /api/employees/{id}         | Show employee details      |
| POST   | /api/employees              | Create new employee        |
| PUT    | /api/employees/{id}         | Update employee            |
| DELETE | /api/employees/{id}         | Soft delete employee       |
| POST   | /api/employees/{id}/restore | Restore deleted employee   |

Search & Filter Examples:  
?name=John&status=active&hired_at=2024-07-01

- Paginated: Yes  
- Response format: JSON (via API Resources)

---

## 🧪 Postman Collection

Import the included Postman collection (postman_collection.json) to test the API endpoints.

---

## 🛠 Advanced Features (Implemented)

- Soft delete & restore
- Eager loading for performance
- Pagination for large datasets
- Validation messages with custom error feedback
- Search optimization (indexed columns: name, status, hired_at)
- Implement 60s cache using Redis 

---

## 🧠 Performance Considerations

- No N+1 queries: Eager loading for department relationships
- Fast search: Indexed name, status, and hired_at
- Pagination: Offset-based pagination with performance tests
- Clean payloads: Optimized API Resources
- Scalability: Tested with 10k+ seeded records

---

## 📁 Folder Structure

app/  
├── Http/  
│   ├── Controllers/  
│   │   └── EmployeeController.php  
│   ├── Requests/  
│   │   ├── StoreEmployeeRequest.php  
│   │   └── UpdateEmployeeRequest.php  
├── Models/  
│   └── Employee.php  
resources/  
└── views/  
    └── employees/  
        ├── index.blade.php  
        ├── create.blade.php  
        └── edit.blade.php  
routes/  
└── web.php  

---

## 📸 Screenshots

(Add screenshots here if desired for UI views: List, Create, Edit, Deleted Restore, etc.)

---

## ✅ To Do / Optional Enhancements

- [ ] Authentication with Laravel Sanctum or Breeze  
- [ ] Employee photo upload  
- [ ] Export to CSV/PDF  
- [ ] Bulk delete  
- [ ] Caching with Redis  
- [ ] Feature tests  

---

## 🧾 License

This project is licensed under the MIT License.

---

## 📅 Deadline

Submission due: Thursday at 4 PM

---

## ✨ Author

Noha Sobhy — https://github.com/your-username
