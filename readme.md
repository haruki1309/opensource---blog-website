# Bugeverywhere. Blog

This is a blog website using Laravel framework in my Open Source Project Subject.

## Getting Started

### Functions

- Users can read many articles on rich topics.
- Users can subscribe to receive notifications of lastest posts.
- Users can search for interest posts by typing some keyword.

- Manager can write new post, edit and delete them.
- Manager can manage categories, tags of posts.
- Manager can approval user's comments in posts.
- Manager can edit informations, change password of his account.
- Manager can manage list of subscriber's email.

## Installation requirement

Firstly, you must have installed one php localhost server like xampp, ampp stacks, laragon, wamppserver,... In this project, i used xampp for localhost environment.
- [XAMPP](https://www.apachefriends.org/index.html)
Secondly, let's install composer - a dependency manager for PHP. Composer is used in all modern PHP frameworks, we'll use this to install laravel project.
- [Composer](https://getcomposer.org/doc/01-basic-usage.md)

After cloning this project, get neccessary packages and make sure you're put it in xampp\htdocs before going to run it.
Move to project directory, then open terminal (or command line) there and run:
1. Install composer to your project
```bash
composer install
```
2. Create .env file to config your database's project. Just copy .env.example to .env and config it
```bash
copy .env.example .env
```
3. Create laravel application's key
```bash
php artisan key:generate
```
To run this web, open your browser and type
```bash
localhost/personalblog/public/
```

## Built with

- [Laravel](https://laravel.com/) - An open source web application framework developed by Taylor Otwell
- [Boostrap 4](https://getbootstrap.com/) - An open source for front-end web application development.
- [jQuery](https://jquery.com/) - A feature-rich JavaScript library.

### Dependencies

- [SB Admin 2](https://startbootstrap.com/themes/sb-admin-2/) - A free Bootstrap 4 admin theme built with HTML/CSS and a modern development workflow environment ready to use to build your next dashboard or web application.
- [Blog template - colorlib/original](https://colorlib.com/wp/template/original/) - Original is, unquestionably, a real eye candy of a free and responsive blogging website template.

### Versioning

The current version is v.1.0.
I will try to develope more in future.

## Authors

- Bùi Trung Tín - 16521239

Contact me by email: trungtin0904@gmail.com
