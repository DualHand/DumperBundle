<?php

namespace DualHand\DumperBundle\Manager;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author David Velasco <dvelasco@wearemarketing.com>
 */
class DumperManager
{
    private $pool;

    private $request;

    /**
     * DumperManager constructor.
     *
     * @param $pool
     * @param $requestStack
     */
    public function __construct($pool, $requestStack)
    {
        $this->pool = $pool;
        $this->request = $requestStack->getCurrentRequest() ?: new Request();
    }

    public function getPropertiesFromObjectClass($objectClass)
    {
        $properties = array();

        if (count($this->pool->getAdminClasses()[$objectClass]) > 1) {
            $adminClass = end($this->pool->getAdminClasses()[$objectClass]);
            $admin = $this->pool->getAdminByAdminCode($adminClass);
        } else {
            $admin = $this->pool->getAdminByClass($objectClass);
        }

        if (null === $admin) {
            return;
        }

        $admin->setRequest($this->request);

        foreach ($admin->getFormFieldDescriptions() as $property) {
            $properties[] = $property->getName();
        }

        return $properties;
    }
}
