<?php

namespace App\Widgets\Content;

use Arrilot\Widgets\AbstractWidget;

class Navigation extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    public function __construct(array $config = [])
    {
        $this->addConfigDefaults([
            'simple_scroll' => false
        ]);

        parent::__construct($config);
    }

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view("widgets.content.navigation", [
            'simple_scroll' => $this->config['simple_scroll'],
            'config' => $this->config,
        ]);
    }
}
