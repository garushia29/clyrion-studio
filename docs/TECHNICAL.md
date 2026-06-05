# Clyrion Studio — Documentación Técnica

> **Versión:** 1.0.0  
> **Última actualización:** Junio 2026  
> **Stack:** Laravel 13, Livewire 4, PostgreSQL 16, TailwindCSS 3, Docker

---

## Índice

1. [Arquitectura General](#1-arquitectura-general)
2. [Estructura del Proyecto](#2-estructura-del-proyecto)
3. [Módulo: Autenticación](#3-módulo-autenticación)
4. [Módulo: Blog](#4-módulo-blog)
5. [Módulo: Portafolio (Proyectos)](#5-módulo-portafolio-proyectos)
6. [Módulo: Tutoriales](#6-módulo-tutoriales)
7. [Módulo: Servicios](#7-módulo-servicios)
8. [Módulo: Contacto](#8-módulo-contacto)
9. [Módulo: Admin Panel](#9-módulo-admin-panel)
10. [Módulo: Analytics](#10-módulo-analytics)
11. [Módulo: SEO](#11-módulo-seo)
12. [Módulo: Media Manager](#12-módulo-media-manager)
13. [Módulo: Content Blocks](#13-módulo-content-blocks)
14. [Módulo: Internacionalización](#14-módulo-internacionalización)
15. [Módulo: Roles y Permisos](#15-módulo-roles-y-permisos)
16. [Módulo: Notificaciones y Activity Log](#16-módulo-notificaciones-y-activity-log)
17. [Módulo: Middleware](#17-módulo-middleware)
18. [Sistema de Diseño (UI/UX)](#18-sistema-de-diseño-uiux)
19. [Dark/Light Mode](#19-darklight-mode)
20. [Docker y DevOps](#20-docker-y-devops)
21. [Pruebas](#21-pruebas)
22. [Despliegue en Producción](#22-despliegue-en-producción)

---

## 1. Arquitectura General

### Stack Tecnológico

| Capa | Tecnología | Versión |
|------|-----------|---------|
| Backend | Laravel | 13.7+ |
| Frontend Dinámico | Livewire | 4.3+ |
| Frontend Reactivo | Alpine.js | 3.4+ |
| CSS Framework | TailwindCSS | 3.x |
| Build Tool | Vite | 8.x |
| Base de Datos | PostgreSQL | 16 |
| Contenedores | Docker + Docker Compose | - |
| Servidor Web | Nginx | Alpine |
| Editor Rich Text | Trix | 2.1+ |

### Patrón Arquitectónico

```
Cliente → Nginx → PHP-FPM (Laravel) → PostgreSQL
                        ↓
                  Livewire (Componentes)
                        ↓
                  Blade + Alpine.js (UI)
```

El sistema sigue una arquitectura **monolítica modular** con Laravel como núcleo:
- Las rutas públicas se manejan con Controladores tradicionales (MVC)
- El panel admin se maneja con Livewire (Componentes full-stack)
- La UI se renderiza en servidor con Alpine.js para interactividad del lado del cliente

### Principios Aplicados

- **SOLID**: Cada clase tiene una responsabilidad única
- **Clean Architecture**: Separación clara entre capas
- **DRY**: Traits reutilizables (WithListPagination, WithSlugGeneration)
- **Convención sobre Configuración**: Sigue convenciones de Laravel

---

## 2. Estructura del Proyecto

```
clyrion-studio/
├── docker/                          # Infraestructura Docker
│   ├── nginx/
│   │   ├── default.conf             # Config local
│   │   └── prod.conf                # Config producción (SSL)
│   └── php/
│       ├── Dockerfile               # Dev
│       ├── Dockerfile.prod          # Producción (multi-stage)
│       └── opcache.ini              # OPcache tuning
│
├── deploy/                          # Scripts de despliegue
│   ├── setup.sh                     # Setup inicial en VPS
│   └── deploy.sh                    # Deploy automatizado
│
├── .github/workflows/
│   └── deploy.yml                   # CI/CD GitHub Actions
│
├── docker-compose.yml               # Entorno local
├── docker-compose.prod.yml          # Entorno producción
├── .env.production.example          # Variables producción
│
├── src/                             # Aplicación Laravel
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/         # Controladores públicos
│   │   │   │   ├── Admin/           # Controladores admin (Media)
│   │   │   │   ├── Auth/            # Auth (Breeze)
│   │   │   │   ├── Controller.php
│   │   │   │   ├── PostController.php
│   │   │   │   ├── ProjectController.php
│   │   │   │   ├── TutorialController.php
│   │   │   │   └── ProfileController.php
│   │   │   ├── Middleware/
│   │   │   │   ├── CheckRole.php
│   │   │   │   ├── SetLocale.php
│   │   │   │   └── TrackPageView.php
│   │   │   └── Requests/
│   │   │
│   │   ├── Livewire/                # Componentes full-stack
│   │   │   ├── BaseComponent.php
│   │   │   ├── ContactForm.php
│   │   │   ├── Admin/               # Panel admin
│   │   │   ├── Components/          # Componentes reutilizables
│   │   │   └── Traits/              # Traits compartidos
│   │   │
│   │   ├── Models/                  # Modelos Eloquent (13)
│   │   ├── Notifications/
│   │   ├── Policies/                # Policies de autorización
│   │   ├── Providers/
│   │   └── View/Components/         # Blade Components
│   │
│   ├── resources/views/             # Vistas Blade
│   ├── routes/
│   ├── database/
│   └── tests/
```

---

## 3. Módulo: Autenticación

**Basado en:** Laravel Breeze (Blade + Livewire)

### Funcionalidades
- Registro de usuarios
- Inicio de sesión
- Restablecimiento de contraseña
- Verificación de email
- Confirmación de contraseña
- Edición de perfil
- Eliminación de cuenta

### Roles
- `admin`: Acceso completo al panel admin
- `user`: Acceso solo a perfil (sin admin)

### Archivos Clave
| Tipo | Archivo | Propósito |
|------|---------|-----------|
| Controladores | `app/Http/Controllers/Auth/*.php` | Lógica de autenticación |
| Middleware | `app/Http/Middleware/CheckRole.php` | Protege rutas admin |
| Vistas | `resources/views/auth/*.blade.php` | UI de autenticación |
| Layout | `resources/views/layouts/guest.blade.php` | Layout para auth |

---

## 4. Módulo: Blog

**Modelo:** `App\Models\Post`  
**Controlador:** `App\Http\Controllers\PostController`  
**Admin CRUD:** `App\Livewire\Admin\PostList`, `App\Livewire\Admin\PostForm`

### Funcionalidades
- Listado paginado con búsqueda (`title`, `excerpt`, `content`)
- Filtro por categoría (`/blog/categoria/{slug}`)
- Filtro por tag (`/blog/tag/{slug}`)
- Detalle de post con posts relacionados (misma categoría)
- Tiempo de lectura automático (200 palabras/minuto)
- Sidebar con categorías, tags populares y posts recientes
- RSS Feed (`/blog/feed.xml`)
- Meta tags SEO dinámicos por post
- CRUD completo desde admin (draft/published)
- Imagen destacada
- Tags como string separado por comas (legacy) + relación polimórfica

### Relaciones
```
Post belongsTo User
Post belongsToMany Category (pivot: category_post)
Post morphToMany Tag (pivot: taggable)
```

### Rutas Públicas
| Método | URI | Acción |
|--------|-----|--------|
| GET | `/blog` | `index` (listado) |
| GET | `/blog/{slug}` | `show` (detalle) |
| GET | `/blog/categoria/{slug}` | `category` |
| GET | `/blog/tag/{slug}` | `tag` |
| GET | `/blog/feed.xml` | `feed` (RSS) |

---

## 5. Módulo: Portafolio (Proyectos)

**Modelo:** `App\Models\Project`  
**Controlador:** `App\Http\Controllers\ProjectController`  
**Admin CRUD:** `App\Livewire\Admin\ProjectList`, `App\Livewire\Admin\ProjectForm`

### Funcionalidades
- Listado de proyectos publicados
- Detalle individual con enlaces (URL, GitHub)
- Tecnologías como array (JSON cast)
- Proyectos destacados en homepage
- Año, orden personalizado (sort_order)
- Meta SEO por proyecto
- CRUD completo desde admin

### Scopes
- `published()`: Solo proyectos con status 'published'
- `featured()`: Proyectos destacados + publicados

---

## 6. Módulo: Tutoriales

**Modelos:** `App\Models\Tutorial`, `App\Models\TutorialSeries`  
**Controlador:** `App\Http\Controllers\TutorialController`  
**Admin CRUD:** `TutorialList`, `TutorialForm`, `TutorialSeriesList`, `TutorialSeriesForm`

### Funcionalidades
- Tutoriales independientes y organizados en series
- Navegación entre tutoriales de una misma serie (anterior/siguiente)
- Niveles de dificultad: beginner, intermediate, advanced
- Duración estimada (minutos)
- Prerrequisitos
- Thumbnail
- Tags polimórficos
- Meta SEO por tutorial
- CRUD completo desde admin

### Relaciones
```
Tutorial belongsTo TutorialSeries
Tutorial belongsTo User
Tutorial morphToMany Tag
TutorialSeries hasMany Tutorial
```

### Rutas Públicas
| Método | URI | Acción |
|--------|-----|--------|
| GET | `/tutoriales` | `index` |
| GET | `/tutoriales/{slug}` | `show` |
| GET | `/tutoriales/serie/{slug}` | `series` |

---

## 7. Módulo: Servicios

**Modelo:** `App\Models\Service`  
**Admin CRUD:** `App\Livewire\Admin\ServiceList`, `App\Livewire\Admin\ServiceForm`

### Funcionalidades
- CRUD completo desde admin
- Activación/desactivación individual
- Orden personalizado (sort_order)
- Auto-generación de slug
- Renderizado en homepage (sección Servicios)

### Vista Pública
Los servicios se muestran en la homepage (`home.blade.php`) consultando directamente:
```php
App\Models\Service::active()->orderBy('sort_order')->get()
```

---

## 8. Módulo: Contacto

**Modelo:** `App\Models\ContactMessage`  
**Componente Livewire:** `App\Livewire\ContactForm`  
**Admin:** `App\Livewire\Admin\ContactMessageList`

### Funcionalidades
- Formulario de contacto público con validación
- Almacenamiento en base de datos
- Notificación por email a administradores
- Panel admin con listado, filtro leído/no leído
- Marcar como leído/no leído
- Eliminación de mensajes

### Notificaciones
- `App\Notifications\ContactMessageNotification`
- Enviado a todos los usuarios con rol `admin`

---

## 9. Módulo: Admin Panel

**Base:** `App\Livewire\Admin\AdminComponent` (extiende `BaseComponent`)

### Dashboard
`App\Livewire\Admin\Dashboard` — Estadísticas generales:
- Conteo de: proyectos, posts, usuarios, categorías, tags
- Mensajes sin leer
- Posts recientes
- Proyectos publicados
- Analytics (visitas 30 días, hoy, únicos)

### Componentes Admin

| Componente | Propósito |
|-----------|-----------|
| `PostList` | Listado paginado con búsqueda y filtro de estado |
| `PostForm` | Crear/editar posts con auto-slug y SEO |
| `ProjectList` | Listado paginado de proyectos |
| `ProjectForm` | Crear/editar proyectos con tecnologías |
| `TutorialList` | Listado de tutoriales |
| `TutorialForm` | Crear/editar tutoriales con serie y tags |
| `TutorialSeriesList` | Listado de series |
| `TutorialSeriesForm` | Crear/editar series |
| `CategoryList` | Listado de categorías (previene borrado si tiene posts) |
| `CategoryForm` | Crear/editar categorías con jerarquía |
| `TagList` | Listado de tags |
| `TagForm` | Crear/editar tags |
| `UserList` | Listado de usuarios (previene eliminar único admin) |
| `UserForm` | Crear/editar usuarios con rol |
| `ServiceList` | Listado de servicios con toggle activo |
| `ServiceForm` | Crear/editar servicios |
| `MediaLibrary` | Biblioteca multimedia con upload |
| `ContactMessageList` | Mensajes con filtro leído/no leído |
| `ContentBlockManager` | Bloques de contenido dinámico |
| `SeoSettings` | Configuración SEO centralizada |

### Componentes Compartidos

| Componente | Propósito |
|-----------|-----------|
| `BaseComponent` | Layout + flash messages |
| `AdminComponent` | Layout admin por defecto |
| `ConfirmModal` | Modal de confirmación para acciones destructivas |
| `FlashMessage` | Notificaciones toast success/error |
| `WithListPagination` | Trait: búsqueda + paginación |
| `WithSlugGeneration` | Trait: auto-slug desde título |

---

## 10. Módulo: Analytics

**Modelo:** `App\Models\PageView`  
**Middleware:** `App\Http\Middleware\TrackPageView`  
**Admin:** `App\Livewire\Admin\Analytics`

### Funcionalidades
- Registro automático de visitas a páginas públicas
- Visitantes únicos (por visitor_id)
- Páginas más visitadas
- Tráfico por día (últimos 30 días)
- Panel admin con gráficos de barras
- Rango de días configurable

### Datos Almacenados
- `path`: Ruta visitada
- `ip_address`: IP del visitante (anonimizada)
- `user_agent`: Navegador
- `referer`: URL de origen
- `visitor_id`: Identificador único de visitante

---

## 11. Módulo: SEO

**Modelo:** `App\Models\SeoSettings`  
**Admin:** `App\Livewire\Admin\SeoSettings`

### Funcionalidades
- Configuración SEO centralizada por ruta pública
- Campos: title, description, image, type (website/article/profile)
- Activación/desactivación individual
- Rutas disponibles: home, about, projects, blog, tutorials
- Meta tags dinámicos en layouts públicos

### Componente Blade
`App\View\Components\MetaTags` — Renderiza meta tags en el `<head>`:
```blade
<x-meta-tags title="..." description="..." />
```

---

## 12. Módulo: Media Manager

**Modelo:** `App\Models\Media`  
**Controlador Admin:** `App\Http\Controllers\Admin\MediaController`  
**Livewire:** `App\Livewire\Admin\MediaLibrary`

### Funcionalidades
- Subida de archivos (jpg, jpeg, png, gif, webp, svg, pdf, doc, docx)
- Límite: 10MB por archivo
- Almacenamiento en `storage/app/public/uploads/`
- Integración con Trix editor (upload automático al insertar imágenes)
- Listado con búsqueda
- Eliminación de archivos
- URL pública generada automáticamente
- Tamaño en formato humano (KB, MB)

---

## 13. Módulo: Content Blocks

**Modelo:** `App\Models\ContentBlock`  
**Admin:** `App\Livewire\Admin\ContentBlockManager`

### Funcionalidades
- Bloques de contenido dinámico key-value
- Tipos: text, html, image, gallery, json
- Activación/desactivación individual
- Orden personalizado
- Útil para banners, secciones editables, etc.

---

## 14. Módulo: Internacionalización

**Archivos:** `lang/en.json`, `lang/es.json`  
**Middleware:** `App\Http\Middleware\SetLocale`

### Funcionalidades
- Soporte: Español (es) e Inglés (en)
- Selector de idioma en navegación pública
- Persistencia en sesión
- Traducciones vía `__('key')` en vistas

### Uso en Vistas
```blade
<h1>{{ __('home.title') }}</h1>
```

---

## 15. Módulo: Roles y Permisos

**Librería:** `spatie/laravel-permission` v8.0  
**Modelo User:** Trait `HasRoles` + campo `role` (legacy)  
**Middleware:** `App\Http\Middleware\CheckRole` (+ middleware Spatie `permission`, `role_or_permission`)

### Roles Disponibles
| Rol | Permisos |
|-----|----------|
| **super-admin** | Todos los permisos (automático al admin por defecto) |
| **admin** | Todos los permisos (asignable desde el panel) |
| **user** | Sin permisos admin |

### Permisos por Módulo
| Módulo | Permisos |
|--------|----------|
| Posts | view, create, edit, delete |
| Projects | view, create, edit, delete |
| Tutorials | view, create, edit, delete |
| Services | view, create, edit, delete |
| Categories | view, create, edit, delete |
| Tags | view, create, edit, delete |
| Users | view, create, edit, delete |
| Media | view, upload, delete |
| Messages | view, delete |
| Analytics | view |
| SEO | view, edit |
| Content Blocks | view, create, edit, delete |
| Roles | view, create, edit, delete |
| Permissions | view, create, edit, delete |

### Componentes Admin
| Componente | Ruta | Propósito |
|------------|------|-----------|
| `RoleList` | `/admin/roles` | Listado paginado de roles con conteo |
| `RoleForm` | `/admin/roles/{create,edit}` | Formulario con checkboxes de permisos agrupados |
| `PermissionList` | `/admin/permissions` | Listado paginado de permisos |
| `PermissionForm` | `/admin/permissions/{create,edit}` | Crear/editar permiso individual |

### User Management
- `UserForm` incluye asignación de roles Spatie (checkboxes)
- `UserList` muestra columna "Roles" con badges
- `syncRoles()` en create/update

### Policies
Todas migradas de `$user->isAdmin()` a `$user->hasPermissionTo()`:
| Policy | Modelo |
|--------|--------|
| `PostPolicy` | Post |
| `ProjectPolicy` | Project |
| `ServicePolicy` | Service |
| `TutorialPolicy` | Tutorial |
| `UserPolicy` | User |

---

## 16. Módulo: Notificaciones y Activity Log

### Notificaciones en Base de Datos
**Tabla:** `notifications` (Laravel standard: UUID, type, notifiable morph, data JSON, read_at)  
**Campanilla en vivo:** `NotificationBell` Livewire component en la top bar del admin

#### Notificaciones Actuales
| Evento | Canal | Notification Class |
|--------|-------|-------------------|
| Nuevo mensaje de contacto | mail + database | `ContactMessageNotification` |
| Contenido creado/actualizado | database | `ModelActivityNotification` |

#### Componentes
| Componente | Ruta | Propósito |
|------------|------|-----------|
| `NotificationBell` | top bar | Badge con conteo + dropdown con últimas 10 no leídas, marcar como leída, "ver todas" |
| `NotificationList` | `/admin/notifications` | Inbox completo con filtros (todas/no leídas/leídas), marcar todas, eliminar |

### Activity Log
**Tabla:** `activity_log` (id, user_id, log_type, model_type, model_id, description, properties JSON, ip_address)  
**Modelo:** `App\Models\ActivityLog`

#### Cómo Funciona
1. **Trait `LogsActivity`** añadido a 11 modelos (Post, Project, Tutorial, Series, Service, Category, Tag, User, ContactMessage, Media, ContentBlock)
2. Dispara evento `ModelActivity` en `created`/`updated`/`deleted`
3. **Listener `LogModelActivity`** crea registro en `activity_log`
4. **Listener `NotifyAdmins`** envía notificación database a admins (excepto deletes)

#### Componente Admin
| Componente | Ruta | Propósito |
|------------|------|-----------|
| `ActivityLogList` | `/admin/activity` | Listado paginado con filtros por tipo/modelo, búsqueda |

### Arquitectura de Eventos
```
Model (via LogsActivity trait)
  └─► ModelActivity event
        ├─► LogModelActivity listener → activity_log table
        └─► NotifyAdmins listener → notifications table (admins)
```

---

## 17. Módulo: Middleware

### CheckRole (`app/Http/Middleware/CheckRole.php`)
Protege rutas admin: verifica que el usuario autenticado tenga el rol requerido (soporta columna `role` legacy + Spatie roles).

### Permission (`Spatie\Permission\Middleware\PermissionMiddleware`)
Middleware de Spatie para proteger rutas por permiso específico.

### RoleOrPermission (`Spatie\Permission\Middleware\RoleOrPermissionMiddleware`)
Middleware de Spatie para proteger rutas por rol o permiso.

### SetLocale (`App\Http\Middleware\SetLocale.php`)
Configura el locale de la aplicación basado en la sesión del usuario.

### TrackPageView (`app/Http/Middleware/TrackPageView.php`)
Registra cada visita a páginas públicas en la tabla `page_views` para analytics.

---

## 18. Sistema de Diseño (UI/UX)

### Paleta de Colores

| Token | Dark Mode | Light Mode | Uso |
|-------|-----------|------------|-----|
| `surface` | `#030712` | `#FFFFFF` | Fondo principal |
| `surface-card` | `#111827` | `#F9FAFB` | Fondo de tarjetas |
| `surface-border` | `#1F2937` | `#E5E7EB` | Bordes |
| `surface-hover` | `#1F2937` | `#F3F4F6` | Hover |
| `surface-input` | `#374151` | `#D1D5DB` | Inputs |
| `brand-500` | `#3B82F6` | `#3B82F6` | Color acento |

### Tipografía
- **Sans**: Figtree (Google Fonts)
- **Mono**: JetBrains Mono (código)

### Componentes CSS
```css
.gradient-text    /* Texto con gradiente brand */
.glass            /* Efecto glassmorphism */
.card             /* Tarjeta estándar */
.card-hover       /* Tarjeta con hover effect */
.section-padding  /* Padding de secciones */
.container-page   /* Contenedor responsive max-w-7xl */
```

### Animaciones
- `fade-in`: Opacidad 0 → 1 (0.5s)
- `slide-up`: Deslizamiento hacia arriba (0.5s)
- `slide-down`: Deslizamiento hacia abajo (0.3s)

---

## 19. Dark/Light Mode

### Implementación
- Estrategia: `darkMode: 'class'` en TailwindCSS
- Clase `.dark` en `<html>` activa el modo oscuro
- CSS variables para colores surface (cambian según tema)
- Text colors overrideados con selectores de especificidad

### Inicialización
Script inline en `<head>` que verifica:
1. `localStorage.getItem('theme') === 'dark'`
2. `window.matchMedia('(prefers-color-scheme: dark)')`
3. Aplica `.dark` class antes del render para evitar FOUC

### Toggle
- Botón con icono de sol/luna en navegación pública y admin
- Alpine.js: `x-data`, `x-init`, `@click`
- Persistencia en localStorage

### Archivos Modificados
| Archivo | Cambio |
|---------|--------|
| `tailwind.config.js` | `darkMode: 'class'`, surface colors → CSS vars |
| `resources/css/app.css` | Variables CSS para ambos temas + text overrides |
| `layouts/public.blade.php` | Theme init script + toggle button |
| `layouts/app.blade.php` | Theme init script |
| `layouts/guest.blade.php` | Theme init script |
| `layouts/navigation.blade.php` | Toggle button en admin nav |

---

## 20. Docker y DevOps

### Entorno Local (`docker-compose.yml`)

| Servicio | Puerto | Propósito |
|----------|--------|-----------|
| `app` | 5173 | PHP 8.3-FPM + Vite |
| `nginx` | 8000:80 | Servidor web |
| `postgres` | 5432 | Base de datos |

### Entorno Producción (`docker-compose.prod.yml`)

| Mejora | Descripción |
|--------|-------------|
| Multi-stage build | Menor tamaño de imagen |
| Sin Vite | Assets precompilados |
| Health checks | Monitoreo de servicios |
| SSL ready | Puerto 443 configurado |
| Sin montar src/ completo | Solo storage persistente |
| OPcache | Configuración optimizada |

### Dockerfile Producción
1. **Stage build**: Instala dependencias, compila assets
2. **Stage final**: Solo PHP-FPM con OPcache, sin dev tools

---

## 21. Pruebas

**Framework:** PHPUnit 12  
**Archivos:** 20 tests

### Cobertura

| Categoría | Tests |
|-----------|-------|
| Unit/Models | Category, Post, Project, User |
| Feature/Auth | Authentication, Registration, Passwords, Email, Profile |
| Feature/Controllers | PostController, ProjectController, TutorialController |
| Feature/Livewire | ContactForm |
| Feature/Middleware | CheckRole, SetLocale |

### Ejecutar Tests
```bash
cd src
php artisan test
```

---

## 22. Despliegue en Producción

### Prerrequisitos
- Servidor VPS con Docker y Docker Compose
- Dominio configurado con DNS
- GitHub Secrets configurados (para CI/CD)

### Setup Inicial (una vez)
```bash
# En el VPS
git clone https://github.com/tu-usuario/clyrion-studio.git
cd clyrion-studio
cp .env.production.example .env
# Editar .env con datos reales
chmod +x deploy/setup.sh
./deploy/setup.sh
```

### SSL (Let's Encrypt)
```bash
docker compose -f docker-compose.prod.yml run --rm certbot certonly \
    --webroot --webroot-path=/var/www/public \
    -d your-domain.com
```

### Despliegue Automático (CI/CD)
GitHub Actions en `.github/workflows/deploy.yml`:
1. `test`: Ejecuta tests con PostgreSQL
2. `deploy`: Copia archivos al VPS via SCP + ejecuta `deploy/deploy.sh`

### Despliegue Manual
```bash
git pull origin master
chmod +x deploy/deploy.sh
./deploy/deploy.sh
```

### Variables de Entorno Requeridas (`.env`)
```
APP_KEY=<generado con php artisan key:generate>
APP_URL=https://tu-dominio.com
DB_PASSWORD=<contraseña segura>
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_USERNAME=correo@gmail.com
MAIL_PASSWORD=<app-password>
```
