<?php
/**
 * plugin-name
 */
namespace PluginMainNamespace\Providers;

use PluginMainNamespace\Exceptions\ProviderNameException;
use wpdb;

class ProviderName extends AbstractProvider
{

    public function __construct(wpdb $wpdb)
    {
        
        $this->table = 'additional-prefix_ProviderName';

        $this->columns = [
            /**
             * Add columns info to this array.
             * column name => column parameters
             */
        ];

        $this->indexes = [
            /**
             * Add indexes info here.
             * index name and column name => index parameters
             */
        ];

        parent::__construct($wpdb);

    }

}
