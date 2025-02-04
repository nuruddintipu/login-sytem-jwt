# React Authentication System with PHP Backend

## Overview
This project is a **React + PHP** authentication system using **JWT** for secure authentication and **httpOnly cookies** for session management. It implements a **stateless authentication approach,** reducing backend load while maintaining security.

## Features
- User Registration
- User Login with Password Verification
- GUID-based User Identification
- Password Update with JWT authentication
- Logout with Cookie cleaning
- JWT-based Authentication with Refresh Tokens
- Secure **httpOnly Cookie** for Token Storage

## Technologies Used
### Frontend (React)
- React.js
- React-Bootstrap
- JWT-based authentication (Access and Refresh Token)

### Backend (PHP)
- PHP (Native, without frameworks)
- JSON-based file storage (`userData.php`)
- JWT-based authentication (Access and Refresh Token)
- Ramsey UUID for GUID generation
- **httpOnly cookies** for secure session management
- CORS-enabled authentication API


## Setup Instructions
### Backend Setup
1. Install PHP and Composer.
2. Navigate to the backend directory and install dependencies:
   ```sh
   composer install
   ```
3. Start a local PHP server:
   ```sh
   php -S localhost:8000
   ```

### Frontend Setup
1. Install Node.js and npm.
2. Navigate to the frontend directory and install dependencies:
   ```sh
   npm install
   ```
3. Start the React development server:
   ```sh
   npm start
   ```

## Security Considerations
- **Password Hashing**: User passwords are stored using `password_hash()` for security.
- **CORS Handling**: Allowed only for `http://localhost:3000` for local development.
- **Session Management**: LocalStorage is used for session persistence on the frontend.

## Future Improvements
- Migrate from JSON-based storage to a database (MySQL or SQLite).
- Implement Role-based Access Control.
- Multi-Factor Authentication

---
**Author:** Nuruddin Tipu  
**Contact:** nuruddintipu.connect@gmail.com  

