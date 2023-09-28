<?php
Route::get('/{url}', [
'as' => 'sum',
'uses' => 'WelcomeController@index',
]);

Route::patch('forms/updatetwo/{id}',[
    'as' => 'admin.forms.updatetwo',
    'uses' => 'Admin\FormsController@updatetwo'
]);   

Route::patch('forms/updatethree/{zip}',[
    'as' => 'admin.forms.updatethree',
    'uses' => 'Admin\FormsController@updatethree'
]);

Route::post('formulario/updates',[
    'as' => 'admin.formulario.updates',
    'uses' => 'FormularioController@updates'
]); 

Route::patch('forms/updatefour/{zip}',[
    'as' => 'admin.forms.updatefour',
    'uses' => 'Admin\FormsController@updatefour'
]);

Route::patch('forms/deletemultiple/{zip}',[
    'as' => 'admin.forms.deletemultiple',
    'uses' => 'Admin\FormsController@deletemultiple'
]);

Route::patch('formulario/enviar/{zip}',[
    'as' => 'formulario.enviar',
    'uses' => 'FormularioController@enviar'
]);

// Authentication Routes...
Route::get('/', 'Auth\LoginController@showLoginForm')->name('auth.login');
Route::post('/', 'Auth\LoginController@login')->name('auth.login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');
Route::get('helvex/logout', [
'as' => 'helvex/logout',
'uses' => 'Auth\LoginController@logout',
]);

// Registration Routes...
Route::get('helvex/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('helvex/register', 'Auth\RegisterController@register')->name('register');
Route::get('catalogo/empresas', 'Auth\RegisterController@empresas')->name('catalogoEmpresa');

// Change Password Routes...
Route::get('helvex/change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('helvex/change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
Route::get('helvex/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
Route::post('helvex/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
Route::get('helvex/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('helvex/password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //Route::get('/home', 'HomeController@index');
    Route::get('/home', [
    'as' => 'home',
    'uses' => 'HomeController@index',
    ]);
    Route::get('biblioteca', [
    'as' => 'biblioteca',
    'uses' => 'Admin\BibliotecaController@index',
    ]);
    Route::get('aplicaciones/{id}', [
    'as' => 'aplicaciones',
    'uses' => 'AplicacionesController@index',
    ]);
    Route::get('aplicaciones/create/{idprograma}', [
    'as' => 'aplicacionescreate',
    'uses' => 'AplicacionesController@create',
    ]);
    Route::resource('aplicaciones', 'AplicacionesController');

    Route::get('formularios/{idprograma}', [
    'as' => 'formularios',
    'uses' => 'FormulariosController@index',
    ]);
    Route::get('formularios/indextwo/{idprograma}/{iduser}', [
    'as' => 'formulariostwo',
    'uses' => 'FormulariosController@indextwo',
    ]);
    Route::get('formularios/create/{idprograma}', [
    'as' => 'formularioscreate',
    'uses' => 'FormulariosController@create',
    ]);

    Route::resource('empresas', 'Admin\EmpresasController');
    Route::resource('formularios', 'FormulariosController');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('applications', 'Admin\ApplicationsController');
    Route::post('applications_mass_destroy', ['uses' => 'Admin\ApplicationsController@massDestroy', 'as' => 'applications.mass_destroy']);
    Route::resource('aplicantes', 'Admin\AplicantesController');
    Route::post('aplicantes_mass_destroy', ['uses' => 'Admin\AplicantesController@massDestroy', 'as' => 'aplicantes.mass_destroy']);
    Route::resource('programs', 'Admin\ProgramsController');
    Route::post('programs_mass_destroy', ['uses' => 'Admin\ProgramsController@massDestroy', 'as' => 'programs.mass_destroy']);
    Route::resource('landing', 'Admin\LandingController');
    Route::post('landing_mass_destroy', ['uses' => 'Admin\LandingController@massDestroy', 'as' => 'landing.mass_destroy']);
    Route::resource('landings', 'Admin\LandingController@create');

    Route::get('aplicantes/index/{idprograma}', [
    'as' => 'aplicantesindex',
    'uses' => 'Admin\AplicantesController@index',
    ]);

    Route::get('landings', [
    'as' => 'landings',
    'uses' => 'Admin\LandingsController@index',
    ]);
    
    Route::get('landing/create/{idprograma}', [
    'as' => 'landing',
    'uses' => 'Admin\LandingController@create',
    ]);

    Route::get('forms/{id}', [
    'as' => 'formsindex',
    'uses' => 'Admin\FormsController@index',
    ]);
    Route::get('forms/createtitulo/{id}/{idprograma}', [
    'as' => 'formscreatetitulo',
    'uses' => 'Admin\FormsController@createtitulo',
    ]);
    Route::get('forms/create/{id}/{idprograma}', [
    'as' => 'formscreate',
    'uses' => 'Admin\FormsController@create',
    ]);
    Route::get('forms/edit/{idpregunta}/{idprograma}/{iduser}', [
    'as' => 'formedit',
    'uses' => 'Admin\FormsController@edit',
    ]);
    Route::get('forms/position/{id}', [
    'as' => 'formsposition',
    'uses' => 'Admin\FormsController@indextwo',
    ]); 
    Route::resource('forms', 'Admin\FormsController');
    Route::post('forms_mass_destroy', ['uses' => 'Admin\FormsController@massDestroy', 'as' => 'forms.mass_destroy']);

    Route::get('formulario/{idformulario}/{idprograma}', [
    'as' => 'formulario',
    'uses' => 'FormularioController@index',
    ]);
    Route::get('formularioedit/edit/{idprograma}', [
    'as' => 'formularioedit',
    'uses' => 'FormularioController@edit',
    ]);
    Route::get('formularioapp/aplicacion/{idprograma}', [
    'as' => 'formularioapp',
    'uses' => 'FormularioController@aplicacion',
    ]);
    Route::resource('formulario', 'FormularioController');

    Route::get('preguntas/{idformulario}/{idprograma}/{iduser}', [
    'as' => 'preguntas',
    'uses' => 'RespuestasController@index',
    ]);
    Route::get('preguntas/mandar/{zip}', [
    'as' => 'mandar',
    'uses' => 'RespuestasController@mandar',
    ]);
    Route::get('detalle/{id}', [
    'as' => 'detalle',
    'uses' => 'Admin\BibliotecaController@detalle',
    ]);
});