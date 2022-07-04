<template>
    <div>
        <component :is="componentName" :items="items"></component>

        <pagination-links :pagination="pagination" :page="page" />
    </div>
</template>

<script>
    export default{
        props: ['url', 'componentName', 'month', 'year', 'page'],
        data(){
            return {
                items: [],
                pagination: {},
            }
        },
        mounted(){            
            axios.get(this.url , {
                        params: {
                            month: this.month, 
                            year: this.year,
                            page: this.page
                        }
                    })
                    .then(res =>{
                        this.items = res.data.data;
                        this.pagination = res.data;
                        delete this.pagination.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
        }
    }
</script>