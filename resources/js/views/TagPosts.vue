<template>
    <div>
        <paginator
            :url="`/api/tags/${this.tag}`"
            component-name="post-list" 
            :page="page"
            :month="month"
            :year="year"
        />
    </div>    
</template>

<script>
    export default{
        props: ['page', 'month', 'year','tag'],
    }
</script>