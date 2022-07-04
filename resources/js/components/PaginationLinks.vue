<template>
    <div class="pagination" v-if="pagination.last_page > 1">
        <nav>
            <ul class="list-unstyled container-flex space-center">
                <li v-for="page in pagination.last_page">
                    <router-link :class="getActiveClass(page)" :to="{
                        name: $route.name,
                        params:{
                            page: page
                        },
                        query:{
                            page: page
                        }
                    }">{{ page }}</router-link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default{
        props:['pagination','page'],
        methods:{
            getActiveClass(page){
                return (typeof this.page === 'undefined') && page == 1 ? 'active' : '';
            }
        }
    }
</script>

<style lang="scss">
    .pagination{
        a.active{
            background-color: #1abc9c;
            color: #fff;
        }
    }
</style>