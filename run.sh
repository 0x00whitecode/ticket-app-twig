#!/bin/bash

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "PHP is not installed. Installing PHP dependencies..."
    
    # Try to install without sudo if possible
    echo "Please install PHP using:"
    echo "sudo apt install php8.2-cli php8.2-mbstring composer"
    echo ""
    echo "Then run:"
    echo "cd ticket-app-twig"
    echo "composer install"
    echo "php -S localhost:8080"
    exit 1
fi

# Check if vendor directory exists
if [ ! -d "vendor" ]; then
    echo "Installing Composer dependencies..."
    if command -v composer &> /dev/null; then
        composer install
    else
        echo "Composer not found. Please install it with:"
        echo "sudo apt install composer"
        exit 1
    fi
fi

# Create necessary directories
mkdir -p cache data assets

# Start PHP server
echo "Starting PHP development server on http://localhost:8080"
echo "Press Ctrl+C to stop the server"
php -S localhost:8080

