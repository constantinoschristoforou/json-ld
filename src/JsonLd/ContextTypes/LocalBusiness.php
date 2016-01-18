<?php

namespace JsonLd\ContextTypes;

class LocalBusiness extends AbstractContext
{
    /**
     * Property structure
     *
     * @var array
     */
    protected $structure = [
        'name'         => null,
        'url'          => null,
        'description'  => null,
        'telephone'    => null,
        'openingHours' => null,
        'address'      => PostalAddress::class,
        'geo'          => GeoCoordinates::class,
    ];

    protected function setTypeAttribute( $type )
    {
        // TODO: Add type validation
        return $type;
    }
}