<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', "Auth\LoginController@showLoginForm");

Route::get('/home', 'DashboardController@index');

Route::get('/perfil', 'UserController@index');

//Users
Route::get('/nuevoUsuario', 'UserController@formNew')->middleware("admin");
Route::get('/listaUsuarios', 'UserController@listUsers')->middleware("admin");
Route::post('/crearNuevoUsuario', 'UserController@crearNuevoUsuario')->middleware("admin");
Route::post('/editar/userAuth', 'UserController@editUserAuth')->middleware("admin");
Route::get('/user/editar/{id}', 'UserController@editUserForm')->middleware("admin");
Route::get('/user/borrar/{id}', 'UserController@deleteUserForm')->middleware("admin");
Route::post('/user/edit', 'UserController@editUser')->middleware("admin");

Route::get('/avatar/{id}', 'UserController@showAvatar');


//Clear Cache facade value:
Route::get('/clear-cache', function() {
     $exitCode = Artisan::call('cache:clear');
     return '<h1>Cache facade value cleared</h1>';
});


//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});




/*
Route::get('/contabilidad', 'ContabilidadController@index');
Route::get('/contabilidad/nuevo', 'ContabilidadController@showForm')->middleware("upload");
Route::get('/contabilidad/file/{id}', 'ContabilidadController@showFile');
Route::post('/contabilidad/crear', 'ContabilidadController@save')->middleware("upload");
Route::post('/contabilidad/editar', 'ContabilidadController@edit')->middleware("upload");
Route::get('/contabilidad/buscar', 'ContabilidadController@find');
Route::get('/contabilidad/editar/{id}', 'ContabilidadController@showEditForm')->middleware("upload");
Route::get('/contabilidad/borrar/{id}', 'ContabilidadController@delete')->middleware("upload");

Route::get('/rh', 'RhController@index');
Route::get('/rh/nuevo', 'RhController@showForm');
Route::get('/rh/file/{id}', 'RhController@showFile');
Route::post('/rh/crear', 'RhController@save');
Route::post('/rh/editar', 'RhController@edit');
Route::get('/rh/buscar', 'RhController@find');
Route::get('/rh/editar/{id}', 'RhController@showEditForm');
Route::get('/rh/borrar/{id}', 'RhController@delete');

Route::get("/areas", "AreasController@index");
Route::get("/area/nuevo", "AreasController@showForm");
Route::post("/area/crear", "AreasController@save");
Route::get("/area/editar/{id}", "AreasController@showEditForm");
Route::post("/area/editar", "AreasController@edit");

Route::get("/tipoDocumental", "TiposDocumentalesController@index");
Route::get("/tipoDocumental/nuevo", "TiposDocumentalesController@showForm");
Route::post("/tipoDocumental/crear", "TiposDocumentalesController@save");
Route::get("/tipoDocumental/editar/{id}", "TiposDocumentalesController@showEditForm");
Route::get("/tipoDocumental/eliminar/{id}", "TiposDocumentalesController@delete");
Route::post("/tipoDocumental/editar", "TiposDocumentalesController@edit");

Route::get("/tipoContrato", "TipoContratoController@index");
Route::get("/tipoContrato/nuevo", "TipoContratoController@showForm");
Route::post("/tipoContrato/crear", "TipoContratoController@save");
Route::get("/tipoContrato/editar/{id}", "TipoContratoController@showEditForm");
Route::get("/tipoContrato/eliminar/{id}", "TipoContratoController@delete");
Route::post("/tipoContrato/editar", "TipoContratoController@edit");

Route::get("/empresas", "EmpresaController@index");
Route::get("/empresa/nuevo", "EmpresaController@showForm");
Route::post("/empresa/crear", "EmpresaController@save");
Route::get("/empresa/editar/{id}", "EmpresaController@showEditForm");
Route::post("/empresa/editar", "EmpresaController@edit");
*/

Route::get("/bienvenida", "UserController@welcome");
Route::get("/cerrarBienvenida", "UserController@closeWelcome");


Route::get("/nuevo/{module}", "ModulesController@newForm")->middleware("upload");
Route::get("/edit/{module}/{file}", "ModulesController@editForm")->middleware("upload");
Route::post("/edit/{module}/{file}", "ModulesController@edit")->middleware("upload");
Route::get("/delete/{file}", "ModulesController@delete")->middleware("upload");
Route::get("/list/{module}", "ModulesController@_list")->name('_list');

Route::get("/trash/{module}", "ModulesController@trash")->middleware("admin");
Route::get("/recycle/{file}", "ModulesController@recycle")->middleware("admin");
Route::post("save/new/{module}", "ModulesController@save")->middleware("upload");

Route::get("/modules/file/{file}", "ModulesController@showFile");

Route::get("/editField/{field}", "ModulesController@editFieldForm")->middleware("admin");
Route::get("/editField/{field}/{row}", "ModulesController@editRowForm")->middleware("admin");
Route::post("/editField/{field}/{row}", "ModulesController@editRow")->middleware("admin");
Route::get("/newRow/{field}", "ModulesController@newFieldForm")->middleware("admin");
Route::post("/newRow/{field}", "ModulesController@newField")->middleware("admin");
Route::get("/delete/{field}/{row}", "ModulesController@deleteRow")->middleware("admin");
Route::get("/recycle/{field}/{row}", "ModulesController@recycleRow")->middleware("admin");

Route::get("/listActivities", "ActivitiesController@_list");
Route::post("/sendMail", "MailController@send");


Route::get("import/{module}", "ModulesController@importForm")->middleware("admin");
Route::post("import/{module}", "ModulesController@import")->middleware("admin");
Route::get("/import/{module}/getTemplate", "ModulesController@getTemplate")->middleware("admin");
