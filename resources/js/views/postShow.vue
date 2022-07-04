<template>
    <div>
        <section class="post container">

            <!-- @include($post->viewType()) -->
            
            <div class="content-post">
    
                <post-header :post="post"></post-header>               
                    
                <div class="image-w-text" v-html="post.body"></div>
    
                <footer class="container-flex space-between">
                    <!-- @include('partials.social-links',['description' => $post->title])-->
                    <social-links :description="post.title" />
                    
                    <tags :post="post"></tags>

                </footer>
                <div class="comments">
                    <div class="divider"></div>
                     
                    <disqus-comments></disqus-comments>
                                            
                </div><!-- .comments -->
            </div>
        </section>
    </div>
</template>

<script>
    export default{
        props: ['url'],
        data(){
            return {
                post: {
                    owner: {},
                    category: {},
                    tags: {},
                    photos: {}
                }
            }
        },
        mounted(){
            axios.get(`/api/blog/${this.url}`)
                    .then(res =>{
                        this.post = res.data;
                    })
                    .catch(err => {
                        console.log(err.response.data);
                    })
        }
    }
</script>