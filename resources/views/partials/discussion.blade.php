<a href="#">{{ $discussion->title }}</a><br>
<p class="meta">Posted by {{ $discussion->user()->name }}</p><br>
<p class="excerpt">{{ substr($discussion->post()->content, 0, 256) }}</p>
<hr>
