# Plugin WeBanner

WeBanner es un plugin de WordPress para el intercambio de banners donde los usuarios pueden ganar puntos basados en impresiones y clics. Los usuarios pueden crear y gestionar sus campañas de banners, seguir su rendimiento y ganar recompensas.

## Características
- Registro de usuario con autenticación por defecto de WordPress.
- Creación de banners de imagen y texto.
- Ganar puntos basados en el rendimiento de los banners.
- Paneles de usuario y administrador completos.
- Prevención de fraude con seguimiento de IP y cookies.
- Herramientas de admin para gestionar campañas y recompensas.

## Instalación

1. Descarga el plugin WeBanner.
2. Sube los archivos del plugin al directorio `/wp-content/plugins/we-banner`.
3. Activa el plugin desde el menú de 'Plugins' en WordPress.

## Configuración

1. Asegúrate de que tu servidor cumple con los requisitos necesarios (Hostinger Pro, PHP).
2. Configura los ajustes del plugin en el panel de administración.

## Guía de Contribución

Damos la bienvenida a contribuciones al plugin WeBanner. Por favor, sigue estas pautas:

1. **Estándares de Codificación**: Sigue los estándares de codificación de WordPress.
2. **Creación de Issues**: Usa el rastreador de issues de GitHub para reportar errores o sugerir características.
3. **Enviar Pull Requests**: Haz un fork del repositorio, realiza tus cambios y envía un pull request.

Para pautas más detalladas, consulta el archivo CONTRIBUTING.md.

# WeBanner

WeBanner es un plugin de intercambio de banners para WordPress donde los usuarios pueden ganar puntos basados en impresiones y clics y gastar sus puntos subiendo campañas a la plataforma.

## Características

- Registro de usuarios con nombre de usuario y correo electrónico.
- Gestión de banners de imagen (720x90px) y texto (tipo AdWords).
- Sistema de créditos basado en impresiones y clics.
- Panel de usuario con estadísticas y gestión de campañas.
- Panel de administrador con estadísticas globales y gestión de campañas.
- Sistema de afiliados con recompensas.
- Gestión de la banca para administrar los puntos generados y recompensas.

## Estructura del Plugin
webanner/
├── assets/
│ ├── css/
│ │ └── styles.css
│ └── js/
│ └── scripts.js
├── includes/
│ ├── class-wbn-registry.php
│ ├── class-wbn-banners.php
│ ├── class-wbn-credits.php
│ ├── class-wbn-reports.php
│ ├── class-wbn-affiliates.php
│ └── class-wbn-bank.php
├── templates/
│ ├── user-dashboard.php
│ └── admin-dashboard.php
├── languages/
│ └── webanner-es_ES.mo
├── wbn.php
└── readme.md
