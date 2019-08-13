<?php

namespace Millwright\MenuBundle\Twig;

use Knp\Menu\ItemInterface;
use Knp\Menu\Renderer\RendererProviderInterface;
use Knp\Menu\Provider\MenuProviderInterface;

class MenuExtension extends \Twig_Extension
{
    /** @var Helper */
    protected $helper;

    /**
     * @param Helper $helper
     */
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('millwright_menu_get', array($this, 'get')),
            new \Twig_SimpleFunction('millwright_menu_render', array($this, 'render'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('millwright_link_render', array($this, 'renderLink'), array('is_safe' => array('html'))),
        );
    }

    /**
     * Retrieves an item following a path in the tree.
     *
     * @param \Knp\Menu\ItemInterface|string $menu
     * @param array $path
     * @return \Knp\Menu\ItemInterface
     */
    public function get($menu, array $path = array())
    {
        return $this->helper->get($menu, $path);
    }

    /**
     * Renders a menu with the specified renderer.
     *
     * @param \Knp\Menu\ItemInterface|string|array $menu
     * @param array $routeParams
     * @param array $options
     * @param string $renderer
     * @return string
     */
    public function render($menu, array $routeParams = array(), array $options = array(), $renderer = null)
    {
        return $this->helper->render($menu, $routeParams, $options, $renderer);
    }

    /**
     * @param       $name link name in menu container
     * @param array $routeParams
     * @param array $options
     * @param null  $renderer
     * @return mixed
     */
    public function renderLink($name, array $routeParams = array(), array $options = array(), $renderer = null)
    {
        return $this->helper->render($name, $routeParams, $options, $renderer, true);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'millwright_menu';
    }
}
