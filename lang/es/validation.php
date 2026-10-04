<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser un texto.',
    'email' => 'El campo :attribute debe ser un correo electrónico válido.',
    'unique' => 'El valor de :attribute ya está registrado.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'date' => 'El campo :attribute debe ser una fecha válida.',
    'in' => 'El valor seleccionado para :attribute no es válido.',
    'exists' => 'El valor seleccionado para :attribute no es válido.',
    'array' => 'El campo :attribute debe ser una lista.',

    'max' => [
        'string' => 'El campo :attribute no debe superar los :max caracteres.',
        'numeric' => 'El campo :attribute no debe ser mayor que :max.',
        'array' => 'El campo :attribute no debe contener más de :max elementos.',
    ],

    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
        'numeric' => 'El campo :attribute debe ser como mínimo :min.',
        'array' => 'El campo :attribute debe contener al menos :min elementos.',
    ],

    'attributes' => [
        'title' => 'título',
        'description' => 'descripción',
        'priority' => 'prioridad',
        'due_date' => 'fecha de vencimiento',
        'project_id' => 'proyecto',
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'projects' => 'proyectos',
        'projects.*' => 'proyecto',
    ],
];
