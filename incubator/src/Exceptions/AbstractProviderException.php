<?php
/**
 * plugin-name
 */
namespace PluginMainNamespace\Exceptions;

use Exception;

class AbstractProviderException extends Exception
{

    const CREATE_TABLE_FAILURE_CODE = -100;
    const CREATE_TABLE_FAILURE_MESSAGE = 'Create table failure.';

}
