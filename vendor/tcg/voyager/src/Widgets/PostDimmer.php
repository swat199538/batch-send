<?php

namespace TCG\Voyager\Widgets;

use Arrilot\Widgets\AbstractWidget;
use TCG\Voyager\Facades\Voyager;

class PostDimmer extends AbstractWidget
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
        $count = Voyager::model('AsCategory')->count();
        $string = $count == 1 ? '个' : '个';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-tools',
            'title'  => "{$count} {$string}短信助手",
            'text'   => "网站上共有 {$count} {$string} 短信助手.",
            'button' => [
                'text' => '查看所有模板',
                'link' => route('voyager.as_category.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.png'),
        ]));
    }
}
