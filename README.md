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

Import the included Postman collection (hr.postman_collection.json) to test the API endpoints.



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

<img width="1892" height="897" alt="Screenshot 2025-07-24 043221" src="https://github.com/user-attachments/assets/08d2eaa1-0a48-4c99-b9f8-72b2d60f08cf" />
<img width="1903" height="908" alt="Screenshot 2025-07-24 043339" src="https://github.com/user-attachments/assets/4d63348e-ed5c-42e8-98d0-c7746aa86e25" />
<img width="1891" height="881" alt="Screenshot 2025-07-24 043958" src="https://github.com/user-attachments/assets/a87e2be8-9189-49a9-85fb-b92ddb788b44" />


---

## 🧾 License

This project is licensed under the MIT License.


---

## ✨ Author

Mohamed Ibrahim — (https://github.com/mohamed101ibrahim)
