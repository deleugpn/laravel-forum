<?php

namespace Bitporch\Forum\ViewComposers;

use Bitporch\Forum\Models\Group;
use Illuminate\Contracts\View\View;

class GroupComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $groups = Group::all();

        $view->with('groups', $groups);
    }
}
