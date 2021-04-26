<?php

    /*
     * For more details about the configuration, see:
     * https://sweetalert2.github.io/#configuration
     */
    return [
        'alert'   => [
            'position'          => 'center',
            'timer'             => 3000,
            'toast'             => FALSE,
            'text'              => NULL,
            'showCancelButton'  => FALSE,
            'showConfirmButton' => FALSE
        ],
        'confirm' => [
            'icon'               => 'warning',
            'position'           => 'center',
            'toast'              => FALSE,
            'timer'              => NULL,
            'showConfirmButton'  => TRUE,
            'showCancelButton'   => TRUE,
            'cancelButtonText'   => 'No',
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor'  => '#d33'
        ]
    ];
