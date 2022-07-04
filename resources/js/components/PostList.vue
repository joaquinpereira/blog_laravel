<template>
    <div>
        <section class="posts container">
            <!-- @if(isset($title))
                <h3>{{ $title }}</h3>
            @endif -->
    
            <post-list-item 
                v-for="post in items" 
                :post="post" 
                :key="post.id"
            />
            
            <!-- empty -->
            <article v-if="!items.length" class="post">
                <div class="content-post">
                    <h1>No hay publicaciones todavía.</h1>
                </div>
            </article>
    
        </section>
    </div>
</template>
<script>
    export default{
        props: ['items']
    }
</script>