<span>Max 30 users. Found: {{sizeof($users)}}</span>
@forelse($users as $user)
    <div class="bg-dark-subtle p-3 rounded-4 my-2 comment-main">
        <div style="white-space: nowrap" class="d-flex justify-content-between">
            <div class="d-flex align-items-center" style="max-width: 40%;">
                <img src="{{ asset('storage/avatars/'.$user->avatar) }}" role="button" data-bs-toggle="modal"
                     data-bs-target="{{ '#post' . $user->id }}" alt="" width="40" height="40"
                     class="rounded-circle me-2">
                <div class="modal fade" id="{{ 'post' . $user->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="" class="p-3">
                        </div>
                    </div>
                </div>
                <a class="truncate text-white text-break my-auto me-2 comment-author" href="{{ route('show.profile', $user) }}">
                    {{ $user->name }}
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="text-center"><h2>No users found</h2></div>
@endforelse
