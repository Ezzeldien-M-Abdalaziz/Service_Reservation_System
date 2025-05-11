# Service Reservation Admin Panel

A Laravel-based admin dashboard for managing user reservations of various services. This panel provides a clear overview of all bookings, their statuses, and enables admin actions like confirming or canceling reservations. The system supports pagination, status filtering, and efficient UI interactions using Blade and Tailwind CSS.

## 1-Setup Instructions

1.  Clone the repository:
    ```bash
    git clone [https://github.com/your-username/reservation-system.git](https://github.com/your-username/reservation-system.git)
    cd reservation-system
    ```
2.  Install dependencies:
    ```bash
    composer install
    ```
3.  Environment setup:
    ```bash
    cp .env.example .env
    ```
4.  Generate app key & migrate database:
    ```bash
    php artisan key:generate
    php artisan migrate --seed
    ```
5.  Run the server:
    ```bash
    php artisan serve
    ```

## ⚙️ Tool Choices & Design Decisions

* **Laravel:** Chosen for its robust MVC architecture and fast development tools like migrations, routing, and Eloquent ORM.
* **Tailwind CSS:** Used for fast and clean UI styling, offering flexibility without writing custom CSS.
* **Blade Templates:** Make it easy to structure reusable views and layout logic.
* **Design Focus:** The system was built with a clean admin-first focus — prioritizing quick access to reservation info and actions.

## 🚫 Known Limitations

* Currently, there’s no role-based access control — only admin access is assumed.
* Filtering supports status only; date range or user-based filters are not yet implemented.
* No email or notification system to inform users of reservation updates.

## Business Requirements Understanding:

The goal of this system is to help service-based businesses manage their customer reservations in an organized and efficient way. It gives admins a clear view of all upcoming bookings and allows them to quickly confirm or cancel reservations with just a click. Instead of relying on spreadsheets or phone calls, everything is handled in one centralized place. This not only saves time but also helps prevent overbooking, missed appointments, or confusion around who’s coming in and when.

## Feature Suggestion

Introducing online payment integration (via Stripe, paymob, or similar) along with automated email or SMS notifications would greatly improve the user experience and operational efficiency. Allowing users to pay when booking builds trust and reduces last-minute cancellations, while notifications help users remember their appointments and keep admins informed in real-time. Together, these features make the system more reliable, professional, and user-friendly.
