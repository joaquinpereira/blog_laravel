<template>
    <div>
        <paginator
            url="/api/posts"
            component-name="post-list" 
            :page="page"
            :month="month"
            :year="year"
        />
    </div>
    
</template>

<script>
    export default{
        props: ['page', 'month', 'year'],
    }
</script>