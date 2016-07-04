<?php

namespace Sfynx\DddBundle\Layer\Domain\Service\Generalisation\Factory;


interface RepositoryFactoryInterface
{
    const ONE_REPOSITORY = "one";
    const ALL_REPOSITORY = "all";
    const GETBYIDS_REPOSITORY = "getByIds";
    const DELETEONE_REPOSITORY = "deleteOne";
    const DELETEMANY_REPOSITORY = "deleteMany";
    const NEW_REPOSITORY = "new";
    const UPDATE_REPOSITORY = "update";

    public function buildRepository($action);
}
