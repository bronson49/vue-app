<template>
   <div class="tab-wrapper">
      <input type="text" :placeholder="placeholder" v-model="input" class="search-inp">
      <span @click="startSearch" class="search-btn">Search</span>
      <ul class="search-list" v-if="results.length" ref="list">
         <li
            v-for="(item, index) in results"
            :key="item.id"
         >
            <div class="text">
               <div class="info-wrapper">
                  <div class="main-info">
                     <p><span class="subtext">{{index+1}}.</span> {{item.title}}</p>
                     <p class="subtext">Оригинальное название: {{item.original_title}}</p>
                     <p>Год: {{getYear(item.release_date)}}</p>
                     <p>Рейтинг: {{item.vote_average}}</p>
                  </div>
                  <div class="actions">
                     <p v-if="inWatchList(item.id)" class="item">Уже в списке желаний</p>
                     <p class="item" v-else
                        @click="addToWatch(item.id, item.title, item.poster_path)">Хочу посмотреть</p>
                  </div>
               </div>
               <p class="subtext"> {{item.overview}}</p>
            </div>
            <div class="image" :style="{backgroundImage :'url('+imgPath+item.poster_path+')'}"></div>
         </li>
      </ul>

      <div class="pagination" v-if="total_pages">
         <span class="prev-page" @click="changePage(currentPage-1)">&#8249;</span>
         <span @click="changePage(1)"
               :class="{active : currentPage === 1}">1</span>
         <span class="separator"
         v-show="currentPage > 4">...</span>

         <span v-for="page in total_pages" :key="page"
         @click="changePage(+page)"
         v-show="showPaginRule(page)"
         :class="{active : currentPage === page}"
         v-text="page"></span>


         <span class="separator"
               v-show="currentPage < total_pages-4">...</span>
         <span @click="changePage(total_pages)" v-text="total_pages"
               :class="{active : currentPage === total_pages}"
               v-show="total_pages > 3"></span>
         <span class="next-page" @click="changePage(currentPage+1)">&#8250;</span>
      </div>

   </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "search",
        data(){
            return {
                placeholder : 'search film',
                input: 'beast',
                testUrl:'https://api.coindesk.com/v1/bpi/currentprice.json',
                url:'https://api.themoviedb.org/3/search/movie',
                key:'20f8223d13800f3effc084fbf27964ab',
                imgPath:'https://image.tmdb.org/t/p/w300/',
                language:'ru',
                currentPage: 1,
                results:[],
                total_pages : 0,
            }
        },
        mounted() {

        },
        computed:{
            filmList: function () {
                const list = this.$store.state.watchList;
                if (list && Array.isArray(list)){
                    return list
                }  else  return [];
            },

        },
        methods:{
            inWatchList:function (filmId) {
                 return this.filmList.some(film => film.film_id == filmId)
            },
            startSearch: function(){
                if (!this.input.length) return;
                let resUrl =
                    `${this.url}?api_key=${this.key}&query=${this.input}&language=${this.language}&page=${this.currentPage}`;
                axios
                    .get(resUrl)
                    .then(response => {
                        this.results = response.data.results || [];
                        this.currentPage = +response.data.page || 1;
                        this.total_pages = +response.data.total_pages || 1;
                        this.$refs.list.scrollTo({top:0, behavior:"smooth"});
                    })
                    .catch(error => console.log(error));


            } ,
            getYear: function (str) {
                if (str) {
                    return str.slice(0, 4) ;
                } else return '-';

            },
            addToWatch:function (film_id, title, poster_path) {
                const filmOptions = new FormData();
                filmOptions.append('film_id', film_id);
                filmOptions.append('title', title);
                filmOptions.append('poster_path', poster_path);
                this.$store.dispatch('addToWatch', filmOptions);
            },
            changePage(num){
                if (num>=1 && num <= this.total_pages){
                    this.currentPage = num;
                    this.startSearch();
                }

            },
            showPaginRule(num){
                return  num !== 1 &&
                    num !== this.total_pages &&
                    num > this.currentPage-3 &&
                    num <= this.currentPage+3

            },
        },

    }
</script>