<span>Found: {{sizeof($cabinets)}}</span>
@forelse($cabinets as $cabinet)
    @if($loop->iteration % 2 == 1)
        <div class="row justify-content-between gap-2">
            @endif
            <div class="col bg-dark-subtle p-3 rounded-4 my-2 comment-main" >
                <div style="white-space: nowrap" class="d-flex justify-content-between">
                    <div class="d-flex align-items-center" style="max-width: 40%;">
                        <a class="truncate text-white text-break my-auto me-2 comment-author"
                           href="{{ route('services.cabinet.show', $cabinet->cabinet) }}">
                            {{ $cabinet->cabinet }}
                        </a>
                    </div>
                </div>
            </div>
            @if($loop->iteration % 2 == 0)
        </div>
    @endif
@empty
    <div class="text-center"><h2>No cabinets found</h2></div>
@endforelse
