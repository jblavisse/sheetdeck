# Symfony & Nuxt Project

Welcome to this project combining **Symfony** for the backend and **Nuxt.js** for the frontend. This guide will help you install and configure the application on your local machine.

## Table of Contents

- [Project Overview](#project-overview)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
  - [1. Clone the Repository](#1-clone-the-repository)
  - [2. Configure the Backend (Symfony)](#2-configure-the-backend-symfony)
  - [3. Configure the Frontend (Nuxt.js)](#3-configure-the-frontend-nuxtjs)
- [Starting the Servers](#starting-the-servers)
- [Accessing the Application](#accessing-the-application)

## Project Overview

This project is a full-stack application built using Symfony and Nuxt.js.

#### Symfony
![Project Overview](https://i.ibb.co/74f4X9Y/Structure-Symfony.png)

#### Nuxt.js
![Project Overview](https://i.ibb.co/3Y1Mjqt/Structure-Nuxt.png)

## Prerequisites

Before getting started, ensure you have the following installed on your machine:

- **PHP** (version 8.2 or higher)
- **Composer**
- **Node.js** (version 18 or higher) and **npm** or **Yarn**
- **Symfony CLI** (optional but recommended)
- **Git**
- **Database** (MySQL)

## Installation

### 1. Clone the Repository

Start by cloning the Git repository to your local machine:

```bash
git clone https://github.com/jblavisse/sheetdeck.git
cd sheetdeck
```

### 2. Configure the Backend (Symfony)

a. Install Dependencies
Navigate to the backend directory and install dependencies using Composer:

```bash
cd backend
composer install
```

#### b. Configure Environment Variables

Open .env and configure the database settings and other necessary variables.

#### c. Generate the Application Key
Generate the application's secret key:

```bash
php bin/console secrets:generate-keys
```

#### d. Migrate the Database

Create the database and run migrations:

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 3. Configure the Frontend (Nuxt.js)

a. Install Dependencies

Return to the root of the project and navigate to the frontend directory to install dependencies with npm or Yarn:

```bash
cd frontend
npm install
```

## Starting the Servers

### Backend (Symfony)

From the backend directory, start the Symfony server:

```bash
symfony server:start
```

### Frontend (Nuxt.js)

From the frontend directory, start the Nuxt development server:

```bash
npm run dev
```

## Accessing the Application

The application is now accessible at :
- Frontend (Nuxt.js): http://localhost:3000
- Backend (Symfony): http://localhost:8000

## Licence

XXX