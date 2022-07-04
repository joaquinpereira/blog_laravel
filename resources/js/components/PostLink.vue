<template>
    <router-link 
        :to="{
            name: 'post_show', 
            params:{ url: post.url }}">
        <slot />
    </router-link>
</template>

<script>
    export default{
        props: ['post']
    }
</script>