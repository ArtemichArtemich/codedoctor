<div class="flex items-center gap-1">
    @php
        $images = $getState();
        $limit = $getLimit() ?? 3;
        $total = count($images);
        $showImages = array_slice($images, 0, $limit);
    @endphp
    
    @foreach($showImages as $image)
        <div class="relative">
            <img 
                src="{{ asset('storage/' . $image) }}" 
                alt="Project image"
                class="w-10 h-10 rounded-full object-cover ring-2 ring-white/10"
                loading="lazy"
                onerror="this.src='/images/placeholder.png'"
            />
        </div>
    @endforeach
    
    @if($total > $limit)
        <div class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-xs font-medium ring-2 ring-white/10">
            +{{ $total - $limit }}
        </div>
    @endif
</div>