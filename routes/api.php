<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Pacientes
    Route::post('pacientes/media', 'PacienteApiController@storeMedia')->name('pacientes.storeMedia');
    Route::apiResource('pacientes', 'PacienteApiController');

    // Atendimentos
    Route::post('atendimentos/media', 'AtendimentoApiController@storeMedia')->name('atendimentos.storeMedia');
    Route::apiResource('atendimentos', 'AtendimentoApiController');
});
