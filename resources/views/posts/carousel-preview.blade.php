<div class="gallery-photos" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 464}'>
    @foreach ($post->photos as $photo)
        <figure class="grid-item grid-item--height2 gallery-image-item">                                
            @if($loop->iteration ===4)                                
                <div class="overlay">{{ $post->photos->count() }} Fotos</div> 
                <img  src="{{ Storage::url($photo->url) }}" class="img-responsive">
                @break
            @else
                <img  src="{{ Storage::url($photo->url) }}" class="img-responsive">
            @endif                                
        </figure>    
    @endforeach                
</div>