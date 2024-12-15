
# Reporte: Sistema de Gestión de Usuarios y Productos

## Introducción

Este proyecto, desarrollado en Laravel, implementa un sistema para la **gestión de usuarios y productos**. Utiliza las capacidades del framework Laravel para organizar el sistema bajo el patrón **Modelo-Vista-Controlador (MVC)**, lo que garantiza una estructura modular, escalable y de fácil mantenimiento. Este reporte detalla cada parte clave del sistema, explicando cómo interactúan los componentes para manejar los datos.

---

## Gestión de Usuarios

El módulo de usuarios permite realizar las operaciones CRUD (Crear, Leer, Actualizar, Eliminar). Esto se logra mediante el modelo `User`, el controlador `UserController`, y las migraciones que definen la tabla en la base de datos.

### Creación de Usuarios

El método `store` del controlador recibe los datos enviados por un formulario o API y los almacena en la base de datos mediante el modelo `User`. Los datos son validados automáticamente por las reglas definidas en el modelo.

#### Código:
```php
public function store(Request $request) {
    return User::create($request->all());
}
```

#### Explicación:
- **`$request->all()`**: Recoge todos los datos enviados en la solicitud.
- **`User::create()`**: Usa los datos recogidos y los guarda en la base de datos.

El modelo `User` incluye validaciones y características para garantizar la seguridad y consistencia de los datos.

---

### Visualización de Usuarios

El método `index` devuelve la lista completa de usuarios registrados, mientras que el método `show` obtiene información específica de un usuario por su `id`.

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
- **`User::all()`**: Recupera todos los registros de la tabla `users`.
- **`User::find($id)`**: Busca un registro específico basado en el `id`.

---

### Actualización de Usuarios

El método `update` modifica un registro existente. Encuentra el usuario por su `id`, luego aplica las actualizaciones proporcionadas.

#### Código:
```php
public function update(Request $request, $id) {
    $user = User::find($id);
    $user->update($request->all());
    return $user;
}
```

#### Explicación:
- **`User::find($id)`**: Encuentra el usuario.
- **`$user->update()`**: Actualiza los datos enviados.

---

### Eliminación de Usuarios

El método `destroy` elimina un usuario del sistema mediante su `id`.

#### Código:
```php
public function destroy($id) {
    User::destroy($id);
}
```

#### Explicación:
- **`User::destroy()`**: Borra el registro correspondiente del sistema.

---

## Gestión de Productos

El módulo de productos funciona de manera similar al de usuarios, permitiendo operaciones CRUD. La tabla `shoes` almacena la información de cada producto.

### Registro de Productos

El método `store` guarda un nuevo producto en la base de datos.

#### Código:
```php
public function store(Request $request) {
    return Shoe::create($request->all());
}
```

#### Explicación:
- Los datos enviados se almacenan en los campos definidos en el modelo `Shoe`.

---

## Migraciones: Creación de Tablas en la Base de Datos

Laravel utiliza migraciones para definir la estructura de las tablas en la base de datos. Este sistema permite mantener un control de las modificaciones y versiones de las tablas.

### Migración de la Tabla `users`

Esta migración define los campos necesarios para gestionar a los usuarios.

#### Código:
```php
Schema::create('users', function (Blueprint $table) {
    $table->id(); // Clave primaria
    $table->string('name'); // Nombre del usuario
    $table->string('email')->unique(); // Email único para cada usuario
    $table->timestamp('email_verified_at')->nullable(); // Fecha opcional de verificación
    $table->string('password'); // Contraseña cifrada
    $table->rememberToken(); // Token de sesión
    $table->timestamps(); // Fechas de creación y actualización
});
```

#### Explicación de los Campos:
1. **`id`**: Clave primaria única.
2. **`name`**: Almacena el nombre del usuario.
3. **`email`**: Correo electrónico del usuario, único para evitar duplicados.
4. **`password`**: Contraseña encriptada.
5. **`timestamps`**: Guarda automáticamente la fecha de creación y última actualización.

---

### Migración de la Tabla `shoes`

Define los campos para gestionar el inventario de productos.

#### Código:
```php
Schema::create('shoes', function (Blueprint $table) {
    $table->id(); // Identificador único
    $table->string('name'); // Nombre del producto
    $table->string('brand'); // Marca del producto
    $table->decimal('price', 8, 2); // Precio con dos decimales
    $table->integer('size'); // Talla del producto
    $table->integer('stock'); // Cantidad disponible
    $table->timestamps(); // Fechas de creación y actualización
});
```

#### Explicación de los Campos:
1. **`id`**: Identificador único de cada producto.
2. **`name`**: Nombre del producto.
3. **`brand`**: Marca del producto.
4. **`price`**: Precio almacenado con precisión de dos decimales.
5. **`size`**: Talla del producto.
6. **`stock`**: Cantidad disponible en inventario.

---

## Rutas: Conexión entre Funcionalidades

Las rutas conectan los controladores con los endpoints que el usuario o cliente puede llamar.

### Rutas de Usuarios

- **GET /users**: Lista todos los usuarios.
- **POST /users**: Crea un nuevo usuario.
- **GET /users/{id}**: Muestra un usuario específico.
- **PUT /users/{id}**: Actualiza un usuario existente.
- **DELETE /users/{id}**: Elimina un usuario.

#### Código:
```php
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
```

---

### Rutas de Productos

- **GET /shoes**: Lista todos los productos.
- **POST /shoes**: Registra un nuevo producto.
- **GET /shoes/{id}**: Obtiene un producto por su ID.
- **PUT /shoes/{id}**: Actualiza un producto.
- **DELETE /shoes/{id}**: Elimina un producto.

#### Código:
```php
Route::get('/shoes', [ShoeController::class, 'index']);
Route::post('/shoes', [ShoeController::class, 'store']);
Route::get('/shoes/{id}', [ShoeController::class, 'show']);
Route::put('/shoes/{id}', [ShoeController::class, 'update']);
Route::delete('/shoes/{id}', [ShoeController::class, 'destroy']);
```

---

## Conclusión

Este sistema ofrece un manejo eficiente y seguro de los datos, permitiendo la administración de usuarios y productos mediante operaciones CRUD. Con el uso de migraciones, modelos y rutas bien estructuradas, se garantiza la escalabilidad y mantenibilidad del proyecto.
