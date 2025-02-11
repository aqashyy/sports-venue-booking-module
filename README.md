# 🏸 Sports Venue Booking System

## 📜 Description
The **Sports Venue Booking System** is a **Laravel 11**-based RESTful API that allows users to **book badminton venues** while ensuring:
- **No overlapping bookings**
- **Time slot availability**
- **Venue working hours compliance**
- **Monthly performance ranking of venues** based on booking counts.

The system is secured using **Laravel Sanctum** for authentication.

---

## 🚀 Features
✔ **User Authentication** (Sanctum)  
✔ **Book venues only during working hours**  
✔ **Prevent overlapping bookings**  
✔ **Allow adjacent bookings**  
✔ **Limit bookings to a maximum of one month in advance**  
✔ **List venues with their booking count**  
✔ **Highlight highest and lowest booked venues**  
✔ **Rank venues based on monthly performance**

---

## 📌 API Endpoints

**Authentication:**

| Method        | Endpoint      | Description  |
| ------------- |:-------------:| ------------:|
| POST          | /api/register | Register user|
| POST          | /api/login    | Login user   |
| GET           | /api/logout   | Logout user  |

**Register request example:**
```json
{
    "name": "john",
    "email": "john@gmail.com",
    "phone": "9999009900",
    "password": "john123"
}
```
**Login request example**
```json
{
    "email": "john@gmail.com",
    "password": "john123"
}
```

**Venue Booking:**

| Method        | Endpoint        | Description    |
| ------------- |:---------------:| --------------:|
| POST          | /api/venue/book | Book venue slot|

**Booking Request Example:**
```json
{
    "venue_id": 1,
    "booking_date": "2025-02-10",
    "start_time": "08:00:00",
    "end_time": "10:00:00"
}
```
**Venue Reports:**

| Method        | Endpoint        | Description  |
| ------------- |:---------------:| ------------:|
| GET           | /api/venue/list | Register user|
| GET           | /api/venue/rank | Login user   |

---
## 🛠 How the Booking System Works

**1️⃣ Users can book venues only during working hours**
**2️⃣ Overlapping bookings are not allowed, but adjacent bookings are permitted**
**3️⃣ Bookings are restricted to one month in advance**
**4️⃣ Venues are ranked monthly:**
* A: More than 15 bookings
* B: Between 10-15 bookings
* C: Between 5-10 bookings
* D: Less than 5 bookings
