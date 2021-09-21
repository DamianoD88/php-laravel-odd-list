<template>
    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header"> {{ post.title }} </h5>
            <img v-if="post.cover" :src="post.cover" :alt="post.title" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title" v-if="post.category">
                    {{ post.category.name }} 
                </h5>                    
                <p class="card-text"> {{ post.content }}</p>
                <PostTag :tags="post.tags"/>
   
            </div>
        </div>
    </div>
</template>

<script>
import PostTag from '../components/PostTag.vue';
export default {
    name: "SinglePost",
    components: {
        PostTag
    },
    data() {
        return {
            post: []
        }
    },
    mounted(){
        // console.log(this.$route.params.slug);
        axios.get('/api/post/'+ this.$route.params.slug)
            .then( response => {
                this.post = response.data.results;
                // console.log(this.post);
            } )
            .catch(error => {
                console.log(error);
            });
        
    }
};
</script>

<style lang="scss" scoped>
</style>