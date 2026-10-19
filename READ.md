# 🩺 ControlMed — Sistema de Control y Gestión de Dosis Médicas

**ControlMed** es un sistema web integral desarrollado en PHP y Python diseñado para registrar pacientes, gestionar sus prescripciones médicas y calcular automáticamente la duración de las dosis y días restantes de medicación.

---

## Características Principales

- **Autenticación Segura de Usuarios:** Registro e inicio de sesión con contraseñas encriptadas (`password_hash` / `password_verify`).
- **Gestión de Pacientes:** Panel interactivo para registrar pacientes, medicamentos, dosis en presentación, dosis indicadas y fechas de receta.
- **Consultas Preparadas (PDO):** Protección contra ataques de inyección SQL.
- **Módulo de Cálculo (Python):** Script en Python (`operatoria.py`) que procesa los días restantes de medicación consumiendo la base de datos MySQL.
- **Diseño Responsivo:** Interfaz clara estilizada con CSS Grid.

---

## Tecnologías Utilizadas

- **Backend Web:** PHP 8.x (PDO)
- **Base de Datos:** MySQL / MariaDB
- **Scripting & Data:** Python 3.x (PyMySQL)
- **Frontend:** HTML5, CSS3 (Grid & Flexbox), Google Fonts (Roboto, Comfortaa)

---

## Estructura del Proyecto

ControlMed/
│
├── assets/
│   └── css/
│       └── style.css          # Estilos del sistema y tablas
├── partials/
│   ├── header.php             # Encabezado reutilizable
│   └── footer.php             # Pie de página reutilizable
├── database.php               # Conexión centralizada a la BD (PDO)
├── index.php                  # Página principal / Landing
├── login.php                  # Inicio de sesión
├── signup.php                 # Registro de nuevos usuarios
├── logout.php                 # Cierre de sesión
├── main2.php                  # Panel principal de administración
├── insertar.php               # Procesamiento de nuevos pacientes
└── operatoria.py              # Script en Python para cálculo de dosis

---

## ⚙️ Instalación y Configuración

### 1. Requisitos previos
- Servidor web local (XAMPP, WAMP o Laragon) con **PHP** y **MySQL**.
- **Python 3.x** instalado.

### 2. Base de Datos
Crea una base de datos en MySQL llamada `php_login_database` y ejecuta las siguientes tablas:

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    medicacion VARCHAR(100),
    dosis INT,
    dosisindicada INT,
    fechareceta DATE
);

CREATE TABLE operatoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    op INT
);

### 3. Ejecución del script de Python
Instala las dependencias necesarias en la consola:

pip install pymysql

Ejecuta el script para calcular días restantes de medicación:

python operatoria.py

---

## 📝 Licencia

Este proyecto es de código abierto bajo la licencia [MIT](LICENSE).
