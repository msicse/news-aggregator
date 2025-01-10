# News Aggregator Project Setup Guide

Follow these steps to set up the News Aggregator Laravel project:

---

## **Step 1: Clone the Repository**

Clone the project repository from GitHub:

```bash
git clone git@github.com:msicse/news-aggregator.git
cd news-aggregator
```

## **Step 2: Copy and Update .env File**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

#### **API keys**

```bash
NEWSAPI_KEY=your_api_key
GUARDIANAPI_KEY=your_api_key
NEWYORKTIMESAPI_KEY=your_api_key
```

## **Step 3: Install Dependencies**

```bash
composer update
```

## **Step 4: Migrate the Database**

```bash
php artisan migrate

```

## **Step 5: Run the Scheduler**

Ensure the Laravel scheduler is running to execute scheduled tasks. Use the following command:

```bash
php artisan schedule:run

```

For continuous scheduling, set up a cron job on your server:

```bash
php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

# API Documentation

### **Base URL:**

```bash
http://yourdomain.com/api
```

### **Endpoints**

```bash
GET /articles
```

#### **Query Parameters**

-   source (string, optional): Filter by a specific source (e.g., BBC).
-   category (string, optional): Filter by a specific category (e.g., Technology).
-   author (string, optional): Filter by a specific author (e.g., John Doe).
-   date (date, optional): Filter by a specific date (e.g., 2025-01-10).

#### **Retrieve a Single Article**

```bash
GET /articles/{id}
```

#### **Path Parameters**

-   id (integer, required): The ID of the article.

#### **Search Articles**

```bash
GET /articles/search
```

##### **Query Parameters**

-   query (string, required): Search keyword (e.g., climate).

#### **Filter Articles**

```bash
GET /articles/filter
```

##### **Query Parameters**

-   sources (string, optional): Comma-separated list of sources (e.g., BBC,CNN).
-   categories (string, optional): Comma-separated list of categories (e.g., Technology,Health).
-   authors (string, optional): Comma-separated list of authors (e.g., John Doe,Jane Smith).
-   date_range (string, optional): Date range in YYYY-MM-DD,YYYY-MM-DD format (e.g., 2025-01-01,2025-01-10).
