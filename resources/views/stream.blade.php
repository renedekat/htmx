<x-app-layout>
    <div class="bg-white flex flex-col gap-6 p-6 lg:flex-row">

        <div class="lg:w-full">
            @fragment('comment-form')
                <form
                    method="post"
                    action="{{ route('comments.store') }}"
                    hx-post="{{ route('comments.store') }}">
                    @csrf
                    <input
                        name="text"
                        required
                        autofocus
                        class="w-full"
                        placeholder="Type your comment and press Enter" />
                </form>
            @endfragment

            <div id="comments"
                 hx-get="{{ route('comments.index') }}"
                 hx-trigger="loadComments"
                 hx-swap="afterbegin"
                 class="mt-2 flex flex-col gap-2">
                @fragment('comments')
                    @if (isset($comments))
                        @foreach ($comments as $comment)
                            <div>
                                <strong>{{ $comment->user->name }}</strong>
                                {{ $comment->text }}
                            </div>
                        @endforeach
                    @endif
                @endfragment
            </div>
        </div>
    </div>
</x-app-layout>
