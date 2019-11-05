<?php

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Pacientes
    Route::delete('pacientes/destroy', 'PacienteController@massDestroy')->name('pacientes.massDestroy');
    Route::post('pacientes/media', 'PacienteController@storeMedia')->name('pacientes.storeMedia');
    Route::resource('pacientes', 'PacienteController');

    // Atendimentos
    Route::delete('atendimentos/destroy', 'AtendimentoController@massDestroy')->name('atendimentos.massDestroy');
    Route::post('atendimentos/media', 'AtendimentoController@storeMedia')->name('atendimentos.storeMedia');
    Route::resource('atendimentos', 'AtendimentoController');
    Route::post('atendimentos_ajax_update', 
        ['uses' => 'AtendimentoController@ajaxUpdate', 'as' => 'atendimentos.ajax_update']);
    Route::post('atendimentos_ajax_new', 
        ['uses' => 'AtendimentoController@ajaxNew', 'as' => 'atendimentos.ajax_new']);
    Route::post('atendimentos_save_event_drop', 
        ['uses' => 'AtendimentoController@ajaxUpdateDrop', 'as' => 'atendimentos.save_event_drop']);
    
    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
