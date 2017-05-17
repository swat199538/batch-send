<?php

namespace TCG\Voyager\Widgets;

use Arrilot\Widgets\AbstractWidget;
use TCG\Voyager\Facades\Voyager;

class UserDimmer extends AbstractWidget
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
        $count = Voyager::model('User')->count();
        $string = $count == 1 ? '人' : '人';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "当前后台用户{$count} {$string}",
            'text'   => "本网站拥有用户{$count} {$string}.",
            'button' => [
                'text' => '查看所有用户',
                'link' => route('voyager.users.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.png'),
        ]));
    }
}
