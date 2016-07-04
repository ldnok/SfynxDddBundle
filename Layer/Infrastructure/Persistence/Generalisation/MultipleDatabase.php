<?php

namespace Sfynx\DddBundle\Layer\Infrastructure\Persistence\Generalisation;


interface MultipleDatabase
{
    const ORM_DATABASE_TYPE = 'orm';
    const ODM_DATABASE_TYPE = 'odm';
    const COUCHDB_DATABASE_TYPE = 'couchdb';
}
