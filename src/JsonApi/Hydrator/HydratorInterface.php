<?php
namespace WoohooLabs\Yin\JsonApi\Hydrator;

use WoohooLabs\Yin\JsonApi\Request\RequestInterface;

interface HydratorInterface
{
    /**
     * @param \WoohooLabs\Yin\JsonApi\Request\RequestInterface $request
     * @param mixed $domainObject
     * @return mixed
     * @throws \WoohooLabs\Yin\JsonApi\Exception\ResourceTypeMissing
     */
    public function hydrate(RequestInterface $request, $domainObject);
}
