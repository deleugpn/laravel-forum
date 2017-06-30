<?php

namespace Bitporch\Forum\Controllers\Discussion;

use Bitporch\Forum\Controllers\Controller;
use Bitporch\Forum\Models\Discussion;
use Carbon\Carbon;

class FlagController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param Request    $request
     * @param Discussion $discussion
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {
        if ($request->has('is_locked')) {
            $discussion->update(['locked_at' => $request->is_locked ? Carbon::now() : null]);
        }

        if ($request->has('is_stickied')) {
            $discussion->update(['stickied_at' => $request->is_stickied ? Carbon::now() : null]);
        }

        return redirect()->route('forum.discussions.show', $discussion->id);
    }
}
