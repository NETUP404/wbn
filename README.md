# WeBanner

WeBanner es un plugin de intercambio de banners para WordPress donde los usuarios pueden ganar puntos basados en impresiones y clics y gastar sus puntos generados subiendo sus campañas a la plataforma.

## Características

- Registro de usuarios con nombre de usuario y correo electrónico.
- Gestión de banners de imagen (720x90px) y texto (tipo AdWords).
- Sistema de créditos basado en impresiones y clics.
- Panel de usuario con estadísticas y gestión de campañas.
- Panel de administrador con estadísticas globales y gestión de campañas.
- Sistema de afiliados con recompensas.
- Gestión de la banca para administrar los puntos generados y recompensas.
- Sistema de tokens para generar y redimir cheques regalo de puntos.

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
│ ├── admin-dashboard.php
│ ├── admin-campaigns.php
│ ├── admin-affiliates.php
│ └── admin-bank.php
├── languages/
│ └── webanner-es_ES.mo
├── wbn.php
└── readme.md

Code
## Instalación

1. Descarga el plugin y súbelo al directorio `wp-content/plugins/` de tu instalación de WordPress.
2. Activa el plugin desde el menú de `Plugins` en WordPress.
3. El plugin creará automáticamente las páginas necesarias para el panel de usuario y administrador.

## Actualizaciones y Mantenimiento

Para futuras actualizaciones, asegúrate de seguir la estructura del plugin y actualizar los archivos correspondientes en el directorio `includes/` y `templates/`. Cada clase y función está documentada en su archivo respectivo para facilitar el mantenimiento.

### Estilos y Diseño

- El diseño debe ser simple y moderno, similar a Google o Microsoft.
- Todos los elementos deben tener bordes finos y redondeados, sombras tenues y un esquema de color consistente.
- El `body` debe ser blanco y el encabezado debe tener detalles en azul marino y morado.
- Asegúrate de que todos los contenedores y títulos cuadren perfectamente sin dejar grandes espacios en blanco.

### Funcionalidades Principales

#### Registro y Autenticación

- Los usuarios se registran con nombre de usuario y correo electrónico.
- Todos los usuarios serán suscriptores por defecto (sin roles adicionales).

#### Formatos de Banners

- Banners de imagen de 720x90px.
- Banners de texto tipo AdWords (720x90px con texto anchor sobre fondo blanco).
- Aprobación manual por parte del administrador.

#### Sistema de Créditos

- Puntos otorgados basados en impresiones y clics.
- 3 puntos por impresión y 90 puntos por clic en banners de imagen.
- 5 puntos por impresión y 120 puntos por clic en banners de texto.
- Conteo de impresiones y clics limitado por IP y tiempo (10 impresiones y 3 clics por IP cada 6 horas).
- La banca se lleva un 25% de los puntos generados por los usuarios.

#### Estadísticas y Reportes

- Panel de usuario muestra puntos ganados y estadísticas de campañas.
- Panel de administrador muestra estadísticas globales y gestión de campañas.
- Reportes detallados sobre impresiones, clics y CTR (Click Through Rate).

#### Bonificaciones y Recompensas

- 400 puntos al registrarse.
- 1200 puntos de recompensa por afiliado (otorgados cuando el nuevo usuario alcanza 1200 puntos).
- Sistema de tokens generados por el administrador para recompensas adicionales.

#### Rotación y Aleatoriedad de Banners

- Rotación aleatoria de banners en la plataforma.
- Código único de banner para cada usuario (sin mostrar sus propias campañas).

## Contacto

Para cualquier duda o problema, por favor contacta a NETUP404.

Descripción de los Archivos
wbn.php: Archivo principal del plugin que inicializa el plugin y carga las clases necesarias. También registra las páginas de usuario y administrador al activar el plugin.

includes/class-wbn-registry.php:

Registra tipos de post personalizados (banners).
Añade menús de administración y páginas de configuración.
includes/class-wbn-banners.php:

Gestiona la creación, edición y eliminación de banners.
Maneja las impresiones y clics en los banners.
Previene el fraude mediante un sistema de seguimiento de cookies.
Añade un cuadrado semitransparente de imagen a los banners.
includes/class-wbn-credits.php:

Maneja el sistema de créditos.
Otorga créditos basados en impresiones y clics.
Inicializa los créditos de usuario al registrarse.
Previene el fraude mediante un sistema de seguimiento de cookies.
includes/class-wbn-reports.php:

Genera reportes y estadísticas para usuarios y administradores.
Muestra puntos ganados y estadísticas de campañas.
includes/class-wbn-affiliates.php:

Gestiona el sistema de afiliados.
Genera URLs de afiliados y redime tokens de afiliados.
includes/class-wbn-bank.php:

Maneja la gestión de la banca y las recompensas.
Permite imprimir puntos y gestionar las ganancias de la banca.
Implementa un sistema de tokens para generar y redimir cheques regalo de puntos.
templates/user-dashboard.php:

Plantilla para el panel de usuario.
Muestra estadísticas y opciones de gestión de campañas.
templates/admin-dashboard.php:

Plantilla para el panel de administrador.
Muestra estadísticas globales y opciones de gestión de campañas.
templates/admin-campaigns.php:

Plantilla para la gestión de campañas en el panel de administrador.
templates/admin-affiliates.php:

Plantilla para la gestión de afiliados en el panel de administrador.
templates/admin-bank.php:

Plantilla para la gestión de la banca en el panel de administrador.
assets/css/styles.css:

Contiene los estilos CSS para el plugin.
Asegura una apariencia consistente y moderna en todas las páginas del plugin.
assets/js/scripts.js:

Contiene los scripts JavaScript para el plugin.
Maneja la impresión de puntos y otras interacciones dinámicas.
readme.md:

Documento que contiene la descripción del plugin, instrucciones de instalación, y detalles sobre su funcionalidad.
