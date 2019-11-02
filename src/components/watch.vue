<template>
      <div class="tab-wrapper">
         <h2>wish list</h2>
         <div class="watch-options" @click="sortByPriority = !sortByPriority">
            <p v-if="sortByPriority">Priority first</p>
            <p v-else>In order of addition</p>
         </div>
         <div class="watch-list" v-if="filmList && filmList.length">
            <div class="watch-item" v-for="item in sortedList" :key="item.id">
               <p class="title">{{item.title}}</p>
               <div class="img" :style="{backgroundImage :'url('+getImg(item.poster_path)+')'}"></div>
               <div class="priority-wrapper"
                     :class="{open : item.open}">
                  <p class="priority"
                     @click="showPriority(item)">
                     Priority: {{item.priority}}</p>
                  <div class="priority-change">
                     <label>
                        <input type="text" v-model="item.priorityNew">
                     </label>
                     <span @click="setPriority(item.film_id, item.priorityNew)">Change</span>
                  </div>
               </div>
               <p @click="deleteFromWatch(item.film_id)" class="delete">Delete</p>
               <p @click="addToViewed(item)" class="viewed">Viewed</p>
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
    import Vue from 'vue'
    import axios from 'axios'
    export default {
        name: "watch",
        data(){
            return{
                sortByPriority: false,
            }
        },

        computed:{
            filmList: function () {
                return this.$store.state.watchList
            },
            sortedList: function(){
                const filmList = this.filmList;
                if (this.sortByPriority){
                    return filmList.slice().sort((a, b)=> b.priority - a.priority)
                } else return filmList

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
                axios.post('controller/watch/deleteWatch.php', filmId).then(()=>{
                    this.$store.dispatch('getToWatch');
                });
            },
            addToFav(item){
                let filmOptions = new FormData();
                filmOptions.append('film_id', item.film_id);
                filmOptions.append('title', item.title);
                filmOptions.append('poster_path', item.poster_path);
                this.$store.dispatch('addFavorite', filmOptions);
            },
            showPriority(item){
                Vue.set(item, 'open', !item.open)
            },
            setPriority(id, value){
                let filmOpt = new FormData();
                filmOpt.append('film_id', id);
                filmOpt.append('priority', value);
                axios.post('controller/watch/setPriority.php', filmOpt).then(()=>{
                    this.$store.dispatch('getToWatch');
                });
            },

            addToViewed(item){
                let filmOptions = new FormData();
                filmOptions.append('film_id', item.film_id);
                filmOptions.append('title', item.title);
                filmOptions.append('poster_path', item.poster_path);
                this.$store.dispatch('addViewed', filmOptions).then(()=>{
                    let filmId = new FormData();
                    filmId.append('film_id', item.film_id);
                    return axios.post('controller/watch/deleteWatch.php', filmId)
                }).then(()=>{
                    this.$store.dispatch('getToWatch');
                });
            },
        },
    }
</script>
