<?php

namespace DualHand\DumperBundle\Extensions\Twig;

/**
 * Shows the admin properties for a given object.
 *
 * @author David Velasco <dvelasco@dualhand.com>
 */
class PropertiesInAdminExtension extends \Twig_Extension
{
    private $environment;

    private $dumperManager;

    /**
     * PropertiesInAdminExtension constructor.
     *
     * @param $dumperManager
     */
    public function __construct($dumperManager)
    {
        $this->dumperManager = $dumperManager;
    }

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
        $objectClass = get_class($object);

        $properties = $this->dumperManager->getPropertiesFromObjectClass($objectClass);

        return $this->environment->render('DualHandDumperBundle:admin_dumper:get_properties.html.twig', array(
            'properties' => $properties,
            'objectClass' => $objectClass,
        ));
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
