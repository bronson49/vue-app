<template>
      <div class="tab-wrapper">
         <h1>watch component</h1>
         <div class="watch-list" v-if="!(typeof filmList === 'string')">
            <div class="watch-item" v-for="item in filmList" :key="item.id">
               <p class="title">{{item.title}}</p>
               <div class="img" :style="{backgroundImage :'url('+getImg(item.poster_path)+')'}"></div>
               <p @click="deleteFromWatch(item.film_id)" class="delete">Удалить</p>
               <p
                     v-if="!isAdded(item.film_id)"
                     @click="addToFav(item)" class="add" > Add To Favorite </p>
               <p v-else class="added"> Also in Favorite </p>
            </div>
         </div>
         <h2 v-else>Список пока пустой</h2>
      </div>
</template>

<script>
   import axios from 'axios'
    export default {
        name: "watch",
        data(){
            return{}
        },

        computed:{
            filmList: function () {
                return this.$store.state.watchList
            },
            favList: function () {
                return this.$store.state.favList
            },


        },
        methods: {
            getImg(path){
                return "https://image.tmdb.org/t/p/w200" + path;
            },
            isAdded: function(film_id){
                return this.favList.some( film => film.film_id === film_id )
            },
            deleteFromWatch(film_id){
                let filmId = new FormData();
                filmId.append('film_id', film_id);
                axios.post('controller/deleteWatch.php', filmId).then(()=>{
                    this.$store.dispatch('getToWatch');
                });
            },
            addToFav(item){
                const filmOptions = new FormData();
                filmOptions.append('film_id', item.film_id);
                filmOptions.append('title', item.title);
                filmOptions.append('poster_path', item.poster_path);
                this.$store.dispatch('addFavorite', filmOptions);
            },
        },
    }
</script>
