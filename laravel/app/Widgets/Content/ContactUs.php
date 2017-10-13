<?php

namespace App\Widgets\Content;

use Arrilot\Widgets\AbstractWidget;

class ContactUs extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        return view("widgets.content.contact_us", [
            'config' => $this->config,
        ]);
    }
}