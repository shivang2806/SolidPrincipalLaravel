<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## SOLID Principals

- [Single Responsibility Principle].
- [Open/Closed Principle].
- [Liskov Substitution Principle].
- [Interface Segregation Principle].
- [Dependency Inversion Principle].

SOLID principles are a set of programming best practices that can help developers create better code. Some benefits of using SOLID principles include

## Important Files

- App\Http\Controllers\UserController
- App\Providers\RepositoryServiceProvider
- App\Services\UserService
- App\Repositories\UserRepository
- App\Interfaces\UserInterface

## Description

- We use Interface to define blue print, remove duplication, improve maintainability, scalability, flexibility, loosely coupled
- We use controller only for responce
- We use reposatory for databse data handling
- We use service for logic handling