# 🌍 Laravel Country API - Complete Geographical Data REST API

> **Free, Open-Source RESTful API for Countries, States, Cities & Bangladesh Administrative Divisions**

A production-ready Laravel REST API providing comprehensive geographical data including 250+ countries, 5000+ states, 143,000+ cities, and complete Bangladesh administrative divisions (divisions, districts, upazilas, unions) with Bengali language support.

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![GitHub](https://img.shields.io/badge/GitHub-webcodecare-blue)](https://github.com/webcodecare)

**Keywords:** Laravel API, Country API, State API, City API, Bangladesh API, Geographical Data API, RESTful API, Location API, Administrative Divisions API, Division District Upazila Union API

## 📋 Table of Contents

- [Features & Capabilities](#-features--capabilities)
- [Quick Start](#-quick-start)
- [Tech Stack](#-tech-stack)
- [Database Schema](#-database-schema)
- [Installation Guide](#-installation)
- [Complete API Documentation](#-api-endpoints)
- [Usage Examples](#-usage-examples)
- [Deployment Guide](#-deployment)
- [Use Cases](#-use-cases)
- [Why Choose This API](#-why-choose-this-api)
- [Contributing](#-contributing)
- [License](#-license)

## ⚡ Quick Start

Get your geographical API up and running in 5 minutes:

```bash
# Clone the repository
git clone https://github.com/webcodecare/country-api.git
cd country-api

# Install dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate

# Setup database (update .env with your database credentials first)
php artisan migrate
php artisan db:seed

# Start the server
php artisan serve
```

Visit `http://localhost:8000/api/countries` to see your API in action!

## ✨ Features & Capabilities

### 🌐 International Geographic Data
- **250+ Countries** - Complete list with ISO2/ISO3 codes and international dial codes
- **5,000+ States/Provinces** - All major administrative regions worldwide
- **143,000+ Cities** - Comprehensive city database across all countries
- **Country-State-City Relationships** - Hierarchical data structure for easy navigation

### 🇧🇩 Bangladesh Administrative Divisions (বাংলাদেশ প্রশাসনিক বিভাগ)
- **8 Divisions (বিভাগ)** - Dhaka, Chattagram, Rajshahi, Khulna, Barisal, Sylhet, Rangpur, Mymensingh
- **64 Districts (জেলা)** - All districts with geo-coordinates (latitude/longitude)
- **495 Upazilas (উপজেলা)** - Complete sub-district level data
- **4,554 Unions (ইউনিয়ন)** - Smallest administrative units for grassroots applications
- **Bilingual Support** - Both English and Bengali (বাংলা) names
- **Government URLs** - Official website links for administrative divisions
- **GPS Coordinates** - Latitude and longitude for mapping applications

### 🔧 Technical Features
- ✅ **Full REST API** - Complete CRUD operations (Create, Read, Update, Delete)
- ✅ **RESTful Design** - Industry-standard REST API architecture
- ✅ **JSON Responses** - Consistent, structured JSON format
- ✅ **Nested Endpoints** - Get states by country, cities by state, districts by division
- ✅ **Error Handling** - Comprehensive error messages and status codes
- ✅ **Database Agnostic** - Works with MySQL and PostgreSQL
- ✅ **Seed Data Included** - Pre-populated JSON files for quick setup
- ✅ **Production Optimized** - Cached routes, configs for high performance
- ✅ **cPanel Compatible** - Easy deployment on shared hosting

## 🛠 Tech Stack

- **Framework**: Laravel 11.x
- **PHP**: 8.1+
- **Database**: MySQL/PostgreSQL
- **Architecture**: MVC with Resource Controllers
- **API**: RESTful JSON API

## 🗃 Database Schema

### International Data
- `countries` - Country information (name, code, ISO3, dial code)
- `states` - States/provinces linked to countries
- `cities` - Cities linked to countries

### Bangladesh-Specific Data
- `divisions` - 8 administrative divisions (বিভাগ)
- `districts` - 64 districts (জেলা) with geo-coordinates
- `upazilas` - 495 sub-districts (উপজেলা)
- `unions` - 4,554 smallest administrative units (ইউনিয়ন)

## 🚀 Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL 5.7+ or PostgreSQL 12+
- Git

### Step 1: Clone the Repository

```bash
git clone https://github.com/webcodecare/country-api.git
cd country-api
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Environment Configuration

```bash
cp .env.example .env
```

Edit `.env` file and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=country_api
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Run Migrations

```bash
php artisan migrate
```

### Step 6: Seed Database

```bash
php artisan db:seed
```

**Note**: Seeding may take a few minutes as it imports 143,000+ cities and other geographical data.

### Step 7: Start Development Server

```bash
php artisan serve
```

Your API will be available at: `http://localhost:8000`

## 📡 Complete API Documentation

All endpoints return JSON responses with consistent structure:
```json
{
  "error": false,
  "msg": "Success message",
  "data": { ... }
}
```

### 🌍 Countries API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/countries` | Get all countries |
| POST | `/api/countries` | Create a new country |
| GET | `/api/countries/{id}` | Get a specific country |
| PUT | `/api/countries/{id}` | Update a country |
| DELETE | `/api/countries/{id}` | Delete a country |
| GET | `/api/countries/{id}/states` | Get states for a country |
| GET | `/api/countries/{id}/cities` | Get cities for a country |

### 🗺️ States/Provinces API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/states` | Get all states/provinces worldwide |
| POST | `/api/states` | Create a new state/province |
| GET | `/api/states/{id}` | Get a specific state with details |
| PUT | `/api/states/{id}` | Update state information |
| DELETE | `/api/states/{id}` | Delete a state |

### 🏙️ Cities API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/cities` | Get all cities (143,000+ records) |
| POST | `/api/cities` | Create a new city |
| GET | `/api/cities/{id}` | Get specific city information |
| PUT | `/api/cities/{id}` | Update city details |
| DELETE | `/api/cities/{id}` | Delete a city |

### 🇧🇩 Bangladesh Divisions API (বিভাগ)

Complete API for Bangladesh's 8 administrative divisions with Bengali language support.

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/divisions` | Get all 8 Bangladesh divisions |
| POST | `/api/divisions` | Create a new division |
| GET | `/api/divisions/{id}` | Get specific division with Bengali name |
| PUT | `/api/divisions/{id}` | Update division information |
| DELETE | `/api/divisions/{id}` | Delete a division |
| GET | `/api/divisions/{id}/districts` | Get all districts under a division |

### 🏛️ Bangladesh Districts API (জেলা)

Access to all 64 districts with geo-coordinates and Bengali translations.

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/districts` | Get all 64 Bangladesh districts |
| POST | `/api/districts` | Create a new district |
| GET | `/api/districts/{id}` | Get district with lat/long coordinates |
| PUT | `/api/districts/{id}` | Update district information |
| DELETE | `/api/districts/{id}` | Delete a district |
| GET | `/api/districts/{id}/upazilas` | Get all upazilas under a district |

### 🏘️ Bangladesh Upazilas API (উপজেলা)

Sub-district level data for all 495 upazilas in Bangladesh.

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/upazilas` | Get all 495 Bangladesh upazilas |
| POST | `/api/upazilas` | Create a new upazila |
| GET | `/api/upazilas/{id}` | Get specific upazila details |
| PUT | `/api/upazilas/{id}` | Update upazila information |
| DELETE | `/api/upazilas/{id}` | Delete an upazila |
| GET | `/api/upazilas/{id}/unions` | Get all unions under an upazila |

### 🏡 Bangladesh Unions API (ইউনিয়ন)

Grassroots administrative unit data - 4,554 unions across Bangladesh.

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/unions` | Get all 4,554 Bangladesh unions |
| POST | `/api/unions` | Create a new union |
| GET | `/api/unions/{id}` | Get specific union information |
| PUT | `/api/unions/{id}` | Update union details |
| DELETE | `/api/unions/{id}` | Delete a union |

## 💡 Usage Examples

### Get All Countries

```bash
curl -X GET http://localhost:8000/api/countries
```

**Response:**
```json
{
  "error": false,
  "msg": "Countries retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Afghanistan",
      "code": "AF",
      "iso3": "AFG",
      "dial_code": "+93",
      "created_at": "2025-11-24T18:12:02.000000Z",
      "updated_at": "2025-11-24T18:12:02.000000Z"
    }
  ]
}
```

### Get Single Country

```bash
curl -X GET http://localhost:8000/api/countries/1
```

### Get States for a Country

```bash
curl -X GET http://localhost:8000/api/countries/1/states
```

### Get All Bangladesh Divisions

```bash
curl -X GET http://localhost:8000/api/divisions
```

**Response:**
```json
{
  "error": false,
  "msg": "Divisions retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Chattagram",
      "bn_name": "চট্টগ্রাম",
      "url": "www.chittagongdiv.gov.bd",
      "created_at": "2025-11-24T18:12:45.000000Z",
      "updated_at": "2025-11-24T18:12:45.000000Z"
    }
  ]
}
```

### Get Districts for a Division

```bash
curl -X GET http://localhost:8000/api/divisions/1/districts
```

### Create a New Country

```bash
curl -X POST http://localhost:8000/api/countries \
  -H "Content-Type: application/json" \
  -d '{
    "name": "New Country",
    "code": "NC",
    "iso3": "NCY",
    "dial_code": "+999"
  }'
```

### Update a Country

```bash
curl -X PUT http://localhost:8000/api/countries/1 \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Updated Country Name",
    "code": "AF",
    "iso3": "AFG",
    "dial_code": "+93"
  }'
```

### Delete a Country

```bash
curl -X DELETE http://localhost:8000/api/countries/1
```

## 📊 Data Statistics

- **Countries**: 250
- **States**: 5,000+
- **Cities**: 143,000+
- **Divisions**: 8 (Bangladesh)
- **Districts**: 64 (Bangladesh)
- **Upazilas**: 495 (Bangladesh)
- **Unions**: 4,554 (Bangladesh)

## 🌐 Deployment

### cPanel Deployment

For detailed cPanel/MySQL deployment instructions, see [DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md)

Quick steps:
1. Upload files to your hosting
2. Configure `.env` with MySQL credentials
3. Run `composer install --optimize-autoloader --no-dev`
4. Run `php artisan migrate --seed`
5. Configure web server to point to `public/` directory

### Production Optimization

```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🗂 Project Structure

```
country-api/
├── app/
│   └── Http/
│       └── Controllers/
│           └── API/
│               ├── CountryController.php
│               ├── StateController.php
│               ├── CityController.php
│               ├── DivisionController.php
│               ├── DistrictController.php
│               ├── UpazilaController.php
│               └── UnionController.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── CountriesTableSeeder.php
│       ├── StatesTableSeeder.php
│       ├── CitiesTableSeeder.php
│       ├── DivisionsTableSeeder.php
│       ├── DistrictsTableSeeder.php
│       ├── UpazilasTableSeeder.php
│       ├── UnionsTableSeeder.php
│       └── *.json (data files)
├── routes/
│   └── api.php
└── public/
    └── index.php
```

## 🧪 Testing

Test your API endpoints:

```bash
# Test countries endpoint
curl http://localhost:8000/api/countries

# Test divisions endpoint
curl http://localhost:8000/api/divisions

# Test nested relationship
curl http://localhost:8000/api/divisions/1/districts
```

## 🔒 Security

- Never commit `.env` file to version control
- Use strong database passwords
- Enable HTTPS in production
- Keep dependencies updated
- Set `APP_DEBUG=false` in production

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a new branch (`git checkout -b feature/your-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/your-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author & Maintainer

**webcodecare** - Full Stack Developer & API Specialist

- GitHub: [@webcodecare](https://github.com/webcodecare)
- Portfolio: [webcodecare Projects](https://github.com/webcodecare?tab=repositories)

## 🎯 Use Cases

This API is perfect for:

- **E-commerce Applications** - Country, state, city selection for shipping addresses
- **Registration Forms** - Location-based user registration with cascading dropdowns
- **Bangladesh Government Applications** - Complete administrative division data (Division → District → Upazila → Union)
- **Mobile Apps** - Location services for Android/iOS applications
- **Travel & Tourism Platforms** - Worldwide destination data
- **Logistics & Delivery Systems** - Address validation and location management
- **Educational Projects** - Learning Laravel REST API development
- **Real Estate Platforms** - Property location categorization

## 🌟 Why Choose This API?

- ✅ **Production-Ready** - Tested and deployed on live servers
- ✅ **Complete Data** - 250 countries, 5000+ states, 143,000+ cities
- ✅ **Bangladesh Focus** - Comprehensive BD administrative data with Bengali support
- ✅ **RESTful Standards** - Clean, predictable API design
- ✅ **Well Documented** - Complete guides for deployment and usage
- ✅ **Free & Open Source** - MIT License, use in any project
- ✅ **Easy Deployment** - Works on cPanel, VPS, cloud hosting
- ✅ **Laravel Best Practices** - Modern PHP framework with MVC architecture

## 🙏 Acknowledgments

- Country, state, and city data sourced from open geographical databases
- Bangladesh administrative division data (বিভাগ, জেলা, উপজেলা, ইউনিয়ন) from official government sources
- Built with [Laravel 11.x](https://laravel.com) - The PHP Framework for Web Artisans
- Geo-coordinates data for accurate location mapping
- Community contributions and feedback

## 📞 Support & Community

If you encounter any issues or have questions:

1. 📖 Check the [DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md) for cPanel/MySQL setup
2. ✅ Review [API_TEST_RESULTS.md](API_TEST_RESULTS.md) for endpoint examples
3. 🐛 [Open an issue](https://github.com/webcodecare/country-api/issues) on GitHub
4. ⭐ Star this repository if you find it helpful!
5. 🔄 Fork and contribute to make it better

## 📈 Project Stats

- **Database Size**: ~143,000+ geographical records
- **API Endpoints**: 43 RESTful endpoints
- **Response Format**: JSON
- **Authentication**: Open (can be extended with Laravel Sanctum/Passport)
- **Database Support**: MySQL, PostgreSQL
- **Server Requirements**: PHP 8.1+, Composer

## 🔗 Related Projects

Looking for more APIs by webcodecare? Check out:
- [webcodecare Repositories](https://github.com/webcodecare?tab=repositories)

---

<p align="center">
<b>Made with ❤️ using Laravel by <a href="https://github.com/webcodecare">webcodecare</a></b>
<br><br>
⭐ Star this repository if you find it useful!
<br>
🔄 Fork it to customize for your needs!
</p>
