<template>
    <div>
        <paginator
            :url="`/api/categorias/${this.category}`"
            component-name="post-list" 
            :page="page"
            :month="month"
            :year="year"
        />
    </div>    
</template>

<script>
    export default{
        props: ['page', 'month', 'year','category']
    }
</script>