# Calculator Application

This is a simple calculator application built with Laravel. It allows users to perform basic arithmetic calculations such as addition, subtraction, multiplication, and division.

## Prerequisites

Before you begin, ensure you have the following installed on your local machine:

- Docker
- Docker Compose

## Getting Started

1. Clone the repository to your local machine:

```bash
git clone https://github.com/izemomar/calculator.git
```

2. Navigate to the project directory:

```bash
cd calculator
```

3. Start the Docker containers using Laravel Sail:

```bash
./vendor/bin/sail up -d
```

4. Install PHP dependencies:

```bash
./vendor/bin/sail composer install
```

5. Install NPM dependencies:

```bash
./vendor/bin/sail npm install
```

6. Generate application key:

```bash
./vendor/bin/sail artisan key:generate
```


7. Visit `http://localhost:8000/calculator` in your web browser to access the calculator application.

## Running Tests

To run the PHPUnit tests, execute the following command:

```bash
./vendor/bin/sail test
```