<?php
/**
 * WPPG-Man
 */
namespace WPPGMan\Exceptions;

class ExceptionsList
{

    const COMMON = [
        '-1' => [
            'message' => 'Incorrect object creation.',
            'code' => -1
        ],
        '-2' => [
            'message' => 'Invalid directory.',
            'code' => -2
        ],
        '-3' => [
            'message' => 'Directory creation failure.',
            'code' => -3
        ]
    ];

}
