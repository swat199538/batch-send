<?php

namespace TCG\Voyager\Widgets;

use Arrilot\Widgets\AbstractWidget;
use TCG\Voyager\Facades\Voyager;

class PageDimmer extends AbstractWidget
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
        $count = Voyager::model('AssistantTemple')->count();
        $string = '个';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-mail',
            'title'  => "{$count} {$string}短信模板",
            'text'   => "网站上共有 {$count} {$string} 短信模板. ",
            'button' => [
                'text' => '查看所有模板',
                'link' => route('voyager.as_temple.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.png'),
        ]));
    }
}
