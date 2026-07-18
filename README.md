# AgroCulture — Farmer Marketplace Platform

This repository contains a **PHP/MySQL web application** for agricultural product trading. Farmers can list produce, buyers can browse and purchase, and both roles share an agro-blog and review system.

The project demonstrates a full database-backed marketplace workflow: user registration (farmer / buyer), product catalog, shopping cart, transactions, reviews, and blog posts with likes and comments.

> **Note:** This repository is intended for academic and educational use as a database course project.

---

## Project Overview

AgroCulture connects farmers and buyers through a shared digital market. Farmers upload products with category, price, and images. Buyers search the catalog, add items to a cart, and complete purchases. The platform also includes profiles, product reviews, and a community blog.

### Main modules

| Module | Description |
|---|---|
| Authentication | Login / register for farmers and buyers |
| Market | Browse and search agricultural products |
| Cart & checkout | Add to cart and complete buy-now transactions |
| Product management | Farmers upload and manage listed products |
| Profiles | View and edit user profile details |
| Reviews | Rate and comment on products |
| Agro-Blog | Write posts, view blogs, likes, and comments |

---

## Features

1. Farmer and buyer registration with session-based login
2. Digital marketplace for fruits, vegetables, and grains
3. Product search and category browsing
4. Shopping cart (`mycart`) and purchase flow (`transaction`)
5. Product upload with image support
6. Farmer / buyer profile view and edit
7. Product reviews and ratings
8. Blog writing, viewing, likes, and comments
9. MySQL schema dump for local setup (`agroculture.sql`)

---

## Database Schema

Primary database: **`agroculture`**

| Table | Purpose |
|---|---|
| `farmer` | Farmer accounts, contact info, rating, profile image |
| `buyer` | Buyer accounts linked to farmer IDs |
| `fproduct` | Farmer products (name, category, info, price, image) |
| `mycart` | Buyer cart items (`bid`, `pid`) |
| `transaction` | Completed purchase / delivery details |
| `review` | Product ratings and comments |
| `blogdata` | Blog posts (title, content, likes, timestamp) |
| `blogfeedback` | Blog comments |
| `likedata` | Blog like mapping |

Import the full schema and sample data from:

```text
agroculture.sql
```

---

## Repository Structure

```text
AgroCulture/
├── README.md
├── agroculture.sql          # MySQL dump (schema + sample data)
├── db.php                   # Database connection
├── index.php                # Landing page (login / register)
├── menu.php                 # Shared navigation
├── market.php               # Marketplace listing
├── productMenu.php
├── productSearch.php
├── uploadProduct.php
├── myCart.php
├── buyNow.php
├── profileView.php
├── profileEdit.php
├── review.php
├── reviewInput.php
├── blogView.php
├── blogWrite.php
├── Login/
├── Profile/
├── Blog/
├── ImagesAg/
├── images/
├── css/
├── js/
├── fonts/
└── bootstrap/
```

---

## Tech Stack

| Item | Value |
|---|---|
| Backend | PHP |
| Database | MySQL / MariaDB |
| Frontend | HTML, CSS, Bootstrap, jQuery |
| Server | Apache (XAMPP / MAMP / WAMP) |
| Connection | `mysqli` via `db.php` |

Default connection settings in `db.php`:

| Setting | Value |
|---|---|
| Host | `localhost` |
| User | `root` |
| Password | *(empty)* |
| Database | `agroculture` |

Update `db.php` if your local MySQL credentials differ.

---

## Installation

### 1. Prerequisites

- PHP 7.4+ (or PHP 8.x)
- MySQL / MariaDB
- Apache with PHP enabled (XAMPP recommended on Windows/macOS)

### 2. Clone the repository

```bash
git clone https://github.com/Tahis-Fzs/agro-culture.git
cd agro-culture
```

### 3. Place the project in the web root

**XAMPP (macOS example):**

```bash
cp -R . /Applications/XAMPP/htdocs/AgroCulture
```

Or open the project folder directly if your local server already points at this directory.

### 4. Create and import the database

1. Start MySQL (via XAMPP Control Panel or `mysql.server start`).
2. Open phpMyAdmin (`http://localhost/phpmyadmin`) or use the MySQL CLI.
3. Create a database named `agroculture` (optional if the dump creates it).
4. Import `agroculture.sql`.

CLI example:

```bash
mysql -u root -e "CREATE DATABASE IF NOT EXISTS agroculture;"
mysql -u root agroculture < agroculture.sql
```

### 5. Configure the connection

Edit `db.php` if needed:

```php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "agroculture";
```

### 6. Run the app

Open in a browser:

```text
http://localhost/AgroCulture/
```

or, if served from this folder:

```text
http://localhost/
```

---

## Usage

### Farmers

1. Register / log in as a farmer.
2. Upload products (`uploadProduct.php`) with category, price, and image.
3. Manage listings visible in the market.
4. Write and engage with agro-blog posts.

### Buyers

1. Register / log in as a buyer.
2. Browse or search products in the market.
3. Add items to cart and complete checkout.
4. Leave reviews on purchased / listed products.
5. Read and comment on blog posts.

---

## Key Pages

| Page | Role |
|---|---|
| `index.php` | Home, login, register |
| `market.php` | Product marketplace |
| `productSearch.php` | Search products |
| `uploadProduct.php` | Farmer product upload |
| `myCart.php` | Shopping cart |
| `buyNow.php` | Purchase / transaction form |
| `profileView.php` / `profileEdit.php` | User profile |
| `review.php` / `reviewInput.php` | Product reviews |
| `blogView.php` / `blogWrite.php` | Agro-blog |

---

## Reproducibility

To recreate a working local demo:

1. Import `agroculture.sql` into MySQL.
2. Keep `db.php` credentials matching your local server.
3. Serve the project over Apache with PHP enabled.
4. Use the sample farmer account from the dump (if retained) or register a new user.

Sample data in the dump includes example products (e.g., Mango, Ladyfinger, Bajra, Banana) and a sample blog post.

---

## Limitations

- Designed for local / academic demonstration, not production deployment
- Default DB credentials are insecure for public hosting
- Password hashing exists in the schema, but production hardening (HTTPS, CSRF, prepared statements everywhere) should be reviewed before any live use
- Image upload and file paths assume a local filesystem layout
- No separate admin dashboard beyond farmer/buyer roles
- UI depends on older Bootstrap / jQuery patterns

---

## Citation

If this project is used in academic work, please cite the repository appropriately.

```bibtex
@misc{agroculture_marketplace,
  title  = {AgroCulture: A PHP/MySQL Farmer Marketplace Platform},
  author = {Tahsin, Md. Shadman},
  year   = {2024},
  note   = {Database course project — agricultural digital market with cart, reviews, and blog},
  url    = {https://github.com/Tahis-Fzs/agro-culture}
}
```

---

## License

Choose a license before public release. Recommended options:

- MIT License for open academic code
- Apache-2.0 for permissive open-source release
- Private repository if course submission rules require restricted sharing

---

## Disclaimer

This software is for educational and demonstration purposes only. It is not intended for commercial agricultural trading without further security and reliability review.
