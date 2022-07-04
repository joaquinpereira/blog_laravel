<template>
    <article class="post">
    
        <!-- @include($post->viewType('home')) -->

        <div class="content-post">
            
            <post-header :post="post"></post-header>

            <p v-html="post.excerpt"></p>

            <footer class="container-flex space-between">
            
                <div class="read-more">
                    <post-link :post="post" class="text-uppercase c-green">Leer más</post-link>
                </div>

                <tags :post="post"></tags>
                
            </footer>
        </div>
    </article>
</template>
<script>
    export default{
        props: ['post']
    }
</script>