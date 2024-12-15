
# Reporte LARAVEL: Sistema de Gestión de Usuarios y Productos

## Introducción

Este proyecto Laravel implementa un sistema completo para la **gestión de usuarios** y **productos** (zapatos), con funcionalidades CRUD (Crear, Leer, Actualizar, Eliminar). Además, incluye el uso de **migraciones**, **modelos**, **controladores**, y **rutas** para una estructura modular, robusta y escalable.

El objetivo principal del sistema es demostrar cómo Laravel permite el desarrollo rápido y organizado de aplicaciones utilizando las mejores prácticas.

---

## Estructura del Proyecto

El proyecto sigue una estructura MVC bien definida:

1. **Modelos**: Representan las tablas en la base de datos y encapsulan la lógica de los datos.
2. **Controladores**: Gestionan la lógica de negocio y conectan los modelos con las vistas o API.
3. **Migraciones**: Definen y versionan las estructuras de las tablas de la base de datos.
4. **Rutas**: Conectan las solicitudes HTTP con los métodos de los controladores.

---

## Gestión de Usuarios

La gestión de usuarios utiliza el modelo `User` y el controlador `UserController`. Este módulo implementa:

### Creación de Usuarios
Los usuarios se crean mediante el método `store` en el controlador. Este método valida y guarda los datos en la tabla `users`. Se espera recibir:

- **name**: Nombre del usuario.
- **email**: Dirección de correo único.
- **password**: Contraseña cifrada.

#### Código:
```php
public function store(Request $request) {
    return User::create($request->all());
}
```

#### Proceso Detallado:
1. El sistema recibe datos a través de `$request`.
2. Se utiliza `User::create()` para insertar el registro en la tabla.
3. Laravel maneja automáticamente el cifrado del password si está configurado en el modelo.

---

### Visualización de Usuarios

La lista completa de usuarios se obtiene con el método `index`, mientras que un usuario específico se visualiza mediante `show`.

#### Código:
```php
public function index() {
    return User::all();
}

public function show($id) {
    return User::find($id);
}
```

#### Explicación:
- `User::all()` devuelve todos los registros de la tabla `users`.
- `User::find($id)` localiza un registro específico usando su clave primaria.

---

### Actualización de Usuarios

El método `update` permite modificar datos de un usuario existente. Encuentra el usuario por su `id` y actualiza los campos enviados.

#### Código:
```php
public function update(Request $request, $id) {
    $user = User::find($id);
    $user->update($request->all());
    return $user;
}
```

#### Explicación Detallada:
1. `find($id)` localiza el registro a actualizar.
2. `update()` aplica los cambios en los campos enviados.

---

### Eliminación de Usuarios

Los usuarios se eliminan del sistema usando el método `destroy`.

#### Código:
```php
public function destroy($id) {
    User::destroy($id);
}
```

#### Explicación:
- Laravel ejecuta un `DELETE` en la base de datos usando `destroy()`.

---

## Gestión de Productos

El módulo de productos utiliza el modelo `Shoe` y el controlador `ShoeController`. Las operaciones CRUD se implementan de manera similar al módulo de usuarios.

### Registro de Productos

Los productos se registran en la base de datos mediante el método `store`. Se espera recibir:

- **name**: Nombre del producto.
- **brand**: Marca.
- **price**: Precio del producto.
- **size**: Talla.
- **stock**: Cantidad disponible.

#### Código:
```php
public function store(Request $request) {
    return Shoe::create($request->all());
}
```

---

### Edición de Productos

El método `update` permite modificar un producto existente en la base de datos. Recibe los nuevos datos a través de `$request` y los aplica al producto identificado por su `id`.

#### Código:
```php
public function update(Request $request, $id) {
    $shoe = Shoe::find($id);
    $shoe->update($request->all());
    return $shoe;
}
```

#### Explicación:
1. **`Shoe::find($id)`**: Busca el producto con el identificador proporcionado.
2. **`update()`**: Aplica los cambios proporcionados en `$request` al registro en la base de datos.

---

### Eliminación de Productos

El método `destroy` elimina un producto del inventario mediante su `id`.

#### Código:
```php
public function destroy($id) {
    Shoe::destroy($id);
}
```

#### Explicación:
1. **`Shoe::destroy($id)`**: Ejecuta un comando `DELETE` para borrar el registro en la tabla `shoes`.
2. Asegura que los datos obsoletos no permanezcan en el sistema.

---

## Migraciones: Creación de Tablas en la Base de Datos

Las migraciones garantizan que las tablas se definan y actualicen correctamente.

#### Migración de Usuarios

La tabla `users` incluye:

- **id**: Identificador único.
- **name**: Nombre del usuario.
- **email**: Correo electrónico único.
- **password**: Contraseña cifrada.
- **timestamps**: Fechas de creación y actualización.

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->timestamps();
});
```

#### Migración de Productos

La tabla `shoes` incluye:

- **id**: Identificador único.
- **name**: Nombre del producto.
- **brand**: Marca.
- **price**: Precio.
- **size**: Talla.
- **stock**: Cantidad en inventario.
- **timestamps**: Fechas de creación y actualización.

```php
Schema::create('shoes', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('brand');
    $table->decimal('price', 8, 2);
    $table->integer('size');
    $table->integer('stock');
    $table->timestamps();
});
```

---

## Rutas: Conexión entre Componentes

Las rutas vinculan las solicitudes HTTP con los métodos de los controladores.

#### Rutas de Usuarios
```php
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
```

#### Rutas de Productos
```php
Route::get('/shoes', [ShoeController::class, 'index']);
Route::post('/shoes', [ShoeController::class, 'store']);
Route::get('/shoes/{id}', [ShoeController::class, 'show']);
Route::put('/shoes/{id}', [ShoeController::class, 'update']);
Route::delete('/shoes/{id}', [ShoeController::class, 'destroy']);
```

---

## Conclusión

Este sistema, basado en Laravel, es un ejemplo completo de cómo implementar una aplicación escalable y bien estructurada para la gestión de datos. Con migraciones para definir tablas, controladores para la lógica de negocio y rutas bien organizadas, ofrece una solución eficiente y fácil de mantener.

---
