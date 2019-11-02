<template>
   <div class="tab-wrapper">
      <h2>viewed list</h2>
      <div class="viewed-list" v-if="viewedList && viewedList.length">
         <div class="viewed-item" v-for="item in viewedList" :key="item.id">
            <p class="title">{{item.title}}</p>
            <div class="img" :style="{backgroundImage :'url('+getImg(item.poster_path)+')'}"></div>
            <p>Viewing date: {{item.date}}</p>
            <p @click="deleteFromViewed(item.film_id)" class="delete">Delete</p>
         </div>
      </div>
      <h2 v-else>Список пока пустой</h2>
   </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "viewed",
        data(){
            return{}
        },

        computed:{
            viewedList: function () {
                return this.$store.state.viewList
            },
        },
        methods:{
            getImg(path){
                return "https://image.tmdb.org/t/p/w200" + path;
            },
            deleteFromViewed(film_id){
                let filmId = new FormData();
                filmId.append('film_id', film_id);
                axios.post('controller/viewed/deleteViewed.php', filmId).then(()=>{
                    this.$store.dispatch('getViewed');
                });
            },
        },
    }
</script>

<style scoped>

</style>