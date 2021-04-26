<?php
    return [
        'admin' => [

            [
                'text' => 'Principal',
                'url'  => 'home',
                'icon' => 'fas fa-fw fa-home',
            ],

            ['header' => ''],

            [
                'text' => 'Rota de Entrega',
                'icon' => 'fas fa-fw fa-plus',
                'url'  => 'routes',
            ]
            ,
            [
                'text'    => 'Administração',
                'icon'    => 'fas fa-fw fa-briefcase',
                'submenu' => [
                    [
                        'text' => 'Auditoria',
                        'url'  => 'audits',
                    ], [
                        'text' => 'Usuários',
                        'url'  => 'users',
                    ],
                ],
            ],
            [
                'text'    => 'Gestão',
                'icon'    => 'fas fa-fw fa-newspaper',
                'submenu' => [
                    [
                        'text' => 'Clientes',
                        'url'  => 'clients',
                    ], [
                        'text' => 'Endereços',
                        'url'  => 'addresses',
                    ],
                    [
                        'text' => 'Importar CSV',
                        'url'  => 'imports',
                    ],
                ],
            ],
        ],

    ];