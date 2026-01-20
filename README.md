# Product Service

Микросервис для поиска и фильтрации товаров, реализованный на **PHP 8.4** и **Laravel 12** с использованием подходов **DDD (Domain-Driven Design)** и **Clean Architecture**.

## Архитектура и Решения

Проект построен с разделением на слои для удобства поддержки и тестирования:

*   **`App/Domain`**: Чистая бизнес-логика (Entity, Enums, DTO). Не зависит от фреймворка.
*   **`App/Infrastructure/Persistence`**: Реализация работы с БД (Eloquent, Query Filters, Mappers).
*   **`App/Application`**: Сервисный слой (Use Cases).
*   **`App/Presenters`**: HTTP слой (Controllers, API Resources).

## Установка и запуск

Для запуска требуется установленный **PHP >= 8.4**, **Composer** и **MySQL**.

1.  **Клонирование репозитория:**
    ```bash
    git clone <repository-url>
    cd product-service
    ```

2.  **Установка зависимостей:**
    ```bash
    composer install
    ```

3.  **Настройка окружения:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Настройка базы данных:**
    *   Создайте пустую базу данных в MySQL (например, `product_service`).
    *   Отредактируйте файл `.env`, указав доступы:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=product_service
        DB_USERNAME=root
        DB_PASSWORD=your_password
        ```

5.  **Миграции и наполнение данными:**
    Команда создаст таблицы и наполнит их тестовыми данными (категории + 300 товаров).
    ```bash
    php artisan migrate --seed
    ```

6.  **Генерация документации Swagger:**
    ```bash
    php artisan l5-swagger:generate
    ```

7.  **Запуск локального сервера:**
    ```bash
    php artisan serve
    ```
    Приложение будет доступно по адресу: `http://127.0.0.1:8000`

## API Документация

В проекте настроен **Swagger UI**. После запуска сервера перейдите по адресу:

**[http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation)**

**Примеры запросов:**
*   Получить все товары: `GET /api/products`
*   Фильтр и сортировка: `GET /api/products?q=Phone&price_from=100&sort=price_asc&in_stock=1`

## Тестирование

### Unit тесты (PHPUnit)
Написаны тесты для проверки бизнес-логики (Domain Layer). Используются Data Providers.
```bash
php artisan test
```

### API тесты (Postman)
Коллекция запросов и настройки окружения находятся в директории tests/Postman/.

Файлы:
- Коллекция: tests/Postman/product_service_local_test.postman_collection.json
- Окружение: tests/Postman/product_service_local.postman_environment.json

Коллекция содержит проверки:
*   Структуры JSON ответа.
*   Корректности фильтрации и сортировки.
*   Валидации входных данных.

**Инструкция:**
1. Импортируйте оба файла в Postman.
2. В правом верхнем углу Postman выберите окружение **"Laravel Product Service Local"**.
3. Запустите тесты вручную или через Collection Runner.



