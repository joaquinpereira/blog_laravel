<template>
    <div>
        <div class="tags container-flex">
                <span class="tag c-gray-1 text-capitalize" v-for="tag in post.tags">
                    <router-link :to="{name: 'tag_posts', params:{tag: tag.url}}">#{{ tag.name }}</router-link>
                </span>    
        </div>
    </div>    
</template>

<script>
    export default {
        props: ['post']
    }
</script>