# Supply Flow

**Supply Flow** is a robust supply chain management system designed to streamline and optimize the flow of goods and services from supplier to customer. Enhance efficiency, improve visibility, and manage your supply chain operations seamlessly with Supply Flow.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Features

- **Admin Dashboard**: Comprehensive control panel for managing the entire supply chain.
- **Retailer Module**: Tools for retailers to manage orders, inventory, and suppliers.
- **Manufacturer Module**: Capabilities for manufacturers to track production, manage materials, and interact with retailers.
- **Real-time Analytics**: Get insights into your supply chain performance with real-time data and reports.
- **User Roles**: Admin, Retailer, Manufacturer roles with specific functionalities.

## Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL
- Node.js & npm (optional, for frontend assets)

### Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/supply-flow.git
    cd supply-flow
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Set up environment variables:
    ```bash
    cp .env.example .env
    ```
    Update the `.env` file with your database credentials and other necessary settings.

4. Generate application key:
    ```bash
    php artisan key:generate
    ```

5. Run migrations:
    ```bash
    php artisan migrate
    ```

6. (Optional) Compile frontend assets:
    ```bash
    npm install
    npm run dev
    ```

7. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage

### Admin

Admins have full access to all features, including user management, supply chain analytics, and system configuration.

### Retailer

Retailers can manage their orders, inventory, and suppliers. They have access to specific reports and analytics relevant to their operations.

### Manufacturer

Manufacturers can track production processes, manage raw materials, and communicate with retailers to fulfill orders.

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Commit your changes (`git commit -m 'Add new feature'`).
5. Push to the branch (`git push origin feature-branch`).
6. Open a pull request.

