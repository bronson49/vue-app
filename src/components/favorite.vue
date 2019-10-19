<template>
   <div class="tab-wrapper">
      <h2>favorite list</h2>
      <div class="fav-list" v-if="favList && favList.length">
         <div class="fav-item" v-for="item in favList" :key="item.id">
            <p class="title">{{item.title}}</p>
            <div class="img" :style="{backgroundImage :'url('+getImg(item.poster_path)+')'}"></div>
            <p @click="deleteFromFav(item.film_id)" class="delete">Удалить</p>
         </div>
      </div>
      <h2 v-else>Список пока пустой</h2>
   </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "favorite",
        data(){
            return{}
        },

        computed:{
            favList: function () {
                return this.$store.state.favList
            },
        },
        methods:{
            getImg(path){
                return "https://image.tmdb.org/t/p/w200" + path;
            },
            deleteFromFav(film_id){
                let filmId = new FormData();
                filmId.append('film_id', film_id);
                axios.post('controller/fav/deleteFav.php', filmId).then(()=>{
                    this.$store.dispatch('getFavorite');
                });
            },
        },
    }
</script>

<style scoped>

</style>