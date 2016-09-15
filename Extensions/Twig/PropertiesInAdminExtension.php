<?php

namespace DualHand\DumperBundle\Extensions\Twig;

use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Shows the admin properties for a given object.
 *
 * @author David Velasco <dvelasco@dualhand.com>
 */
class PropertiesInAdminExtension extends \Twig_Extension
{
    private $pool;

    private $request;

    private $environment;

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('prop', array($this, 'getProperties'), array('is_safe' => array('html')),
                array('needs_environment' => true)),
        );
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getProperties($object)
    {
        $properties = array();

        $objectClass = get_class($object);

        $admin = $this->pool->getAdminByClass($objectClass);

        if (null === $admin) {
            return;
        }

        $admin->setRequest($this->request);

        foreach ($admin->getFormFieldDescriptions() as $property) {
            $properties[] = $property->getName();
        }

        return $this->environment->render('DualHandDumperBundle:admin_dumper:get_properties.html.twig', array(
            'properties' => $properties,
            'objectClass' => $objectClass,
        ));
    }

    /**
     * Getter for request.
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Setter for request.
     *
     * @return PropertiesInAdminExtension
     */
    public function setRequest(RequestStack $request)
    {
        $this->request = $request->getCurrentRequest();

        return $this;
    }

    /**
     * Getter for pool.
     *
     * @return mixed
     */
    public function getPool()
    {
        return $this->pool;
    }

    /**
     * Setter for pool.
     *
     * @return PropertiesInAdminExtension
     */
    public function setPool($pool)
    {
        $this->pool = $pool;

        return $this;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'dualhand.dumper.properties_in_admin.twig.extension';
    }
}
