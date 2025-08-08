# ✅ Laravel Bus Schedule Finder

A simple and structured Bus Schedule Finder built with Laravel, designed to practice and demonstrate **One-to-Many database relationships**.
The app displays bus details, stops, and timings — and supports multiple buses sharing the same route name.

---

## 📌 Features

🚌 Display bus details (name, route name, source, destination, timings)
📍 Show all stops with respective arrival times
🔗 **One-to-Many relationship:**

* One bus → Many stops
* Multiple buses → Same route name
  📱 Fully responsive for mobile, tablet, and desktop
  ✏️ Clean, easy-to-understand UI for browsing schedules

---

## 📂 Tech Stack

**Backend:** Laravel 10+
**Frontend:** Blade templating, Bootstrap
**Database:** MySQL
**Styling:** Custom CSS + Bootstrap

---

## ⚙️ Getting Started

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/jevinkalathiya/laravel-bus-schedule-finder.git
cd laravel-bus-schedule-finder
```

### 2️⃣ Install Dependencies

```bash
composer install
```

### 3️⃣ Set Up `.env`

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database details:

```env
DB_CONNECTION=mysql
DB_DATABASE=your_db_name
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Run Migrations

```bash
php artisan migrate
```

### 5️⃣ Serve the App

```bash
php artisan serve
```

Visit:
[http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📊 Database Relationships Demonstrated

* **One Bus → Many Stops**
* **Multiple Buses → Same Route Name**

---

## 📸 Screenshot

* **Index Page**
![image_alt](https://github.com/jevinkalathiya/laravel-bus-schedule-finder/blob/448f8e14206936c4cb4193748a237282d895d0ca/public/img/Index.png)

* **Admin Page**
![image_alt](https://github.com/jevinkalathiya/laravel-bus-schedule-finder/blob/448f8e14206936c4cb4193748a237282d895d0ca/public/img/Admin.png)

* **Search Result Page**
![image_alt](https://github.com/jevinkalathiya/laravel-bus-schedule-finder/blob/448f8e14206936c4cb4193748a237282d895d0ca/public/img/Result.png)

* **Route Detail Page**
![image_alt](https://github.com/jevinkalathiya/laravel-bus-schedule-finder/blob/448f8e14206936c4cb4193748a237282d895d0ca/public/img/Route%20Details.png)

---

## 🎥 Demo Video

🔗 [Watch Demo on LinkedIn](https://www.linkedin.com/posts/jevinkalathiya_webdevelopment-laravel-php-activity-7359464305483833344-jhMA?utm_source=share&utm_medium=member_desktop&rcm=ACoAADrixywBvDRQhYn_GR5HjrkZg2u0r7ZKGXE)

---

## 👤 Author

**Jevin Kalathiya**  
🔗 [GitHub Profile](https://github.com/jevinkalathiya)
🔗 [LinkedIn Profile](https://in.linkedin.com/in/jevinkalathiya)

---
