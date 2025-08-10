# Unit Converter

[![Laravel](https://img.shields.io/badge/Laravel-11-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

A comprehensive web-based unit converter built with Laravel that allows users to convert between different units of length, weight, and temperature. This project is part of the [Roadmap.sh Backend Projects](https://roadmap.sh/projects/unit-converter) challenge.

![Unit Converter Screenshot](public/screenshot.png)

## 🎯 Project Overview

This Unit Converter is a full-stack web application that provides an intuitive interface for converting between various units across three main categories:

- **Length**: meters, kilometers, centimeters, millimeters, feet, inches, yards, miles
- **Weight**: grams, kilograms, pounds, ounces, stones, tons  
- **Temperature**: Celsius, Fahrenheit, Kelvin

## ✨ Features

- **Single Page Interface**: All conversion types handled in one unified view
- **Dynamic Unit Selection**: Units change based on the selected conversion type
- **Real-time Validation**: Form validation with error handling
- **Responsive Design**: Works seamlessly on desktop and mobile devices
- **Quick Reference**: Built-in conversion reference guides
- **Session Persistence**: Remembers your last conversion settings
- **Clean UI**: Modern, user-friendly interface built with Tailwind CSS

## 🚀 Technologies Used

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates, Tailwind CSS
- **Styling**: Vite for asset compilation
- **Language**: PHP 8.2+
- **Architecture**: MVC Pattern

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js and npm (for frontend assets)

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/jmlc643/unit-converter.git
   cd unit-converter
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Copy environment file**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Build frontend assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

8. **Visit the application**
   Open your browser and go to `http://localhost:8000`

## 🎮 Usage

1. **Select Conversion Type**: Choose between Length, Weight, or Temperature from the navigation tabs
2. **Enter Value**: Input the numerical value you want to convert
3. **Select Units**: Choose the source unit (From) and target unit (To)
4. **Convert**: Click the convert button to see the result
5. **View Result**: The conversion result will be displayed below the form

### Example Conversions

- **Length**: 100 meters = 328.084 feet
- **Weight**: 1 kilogram = 2.20462 pounds
- **Temperature**: 25°C = 77°F = 298.15K

## 🏗️ Project Structure

```
unit-converter/
├── app/
│   └── Http/
│       └── Controllers/
│           └── UnitConverterController.php  # Main conversion logic
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php               # Base layout
│       └── index.blade.php                 # Main converter interface
├── routes/
│   └── web.php                             # Application routes
└── public/                                 # Public assets
```

## 🧮 Conversion Logic

The converter uses a base unit conversion approach:

- **Length**: All units convert to meters as the base unit
- **Weight**: All units convert to grams as the base unit  
- **Temperature**: All units convert to Celsius as the base unit

This ensures accuracy and makes it easy to add new units in the future.

## 🎨 Design Decisions

- **Single Page Application**: Instead of separate pages for each conversion type, everything is handled in one view for better user experience
- **Session State Management**: The application remembers the last conversion type and values
- **Progressive Enhancement**: The interface works without JavaScript but provides enhanced experience with it
- **Mobile-First**: Responsive design that works on all device sizes

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request. For major changes, please open an issue first to discuss what you would like to change.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🔗 Links

- **Live Demo**: [Coming Soon]
- **Roadmap.sh Challenge**: [Unit Converter Project](https://roadmap.sh/projects/unit-converter)
- **Repository**: [GitHub](https://github.com/jmlc643/unit-converter)

## 👨‍💻 Author

**jmlc643**
- GitHub: [@jmlc643](https://github.com/jmlc643)

---

Built with ❤️ as part of the Roadmap.sh Backend Development Projects
