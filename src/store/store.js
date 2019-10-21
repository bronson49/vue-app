import Vue from 'vue'
import Vuex from 'vuex';
import axios from 'axios'

Vue.use(Vuex);

const store = new Vuex.Store({
    state:{
        test : 'title app',
        watchList:[],
        favList:[],
        activeTabIndex: 0,
        rotateStep:15,
    },
    getters:{

    },
    mutations:{
        generateWatchList(state, filmArr){
            if (Array.isArray(filmArr)){
                state.watchList = filmArr;
            } else  state.watchList = [];
        },
        generateFavList(state, filmArr){
            if (Array.isArray(filmArr)){
                state.favList = filmArr;
            } else  state.favList = [];
        },
        rotateTabList(state, index){
            state.activeTabIndex = index;
        },
    },
    actions:{
        addToWatch ({dispatch}, filmOpt){
            axios({
                    method: 'POST',
                    url: 'controller/watch/addWatch.php',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    data: filmOpt
            })
            .then(() => {
                dispatch('getToWatch');
            })
            .catch(error => console.log(error));
        },
        getToWatch({commit}){
            axios.get('controller/watch/getWatch.php').then(response => {
                commit('generateWatchList', response.data);
            }).catch(error => console.log(error));
        },

        addFavorite ({dispatch}, filmOpt){
            axios({
                method: 'POST',
                url: 'controller/fav/addFav.php',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                data: filmOpt
            })
                .then(() => {
                    dispatch('getFavorite');
                })
                .catch(error => console.log(error));
        },
        getFavorite({commit}){
            axios.get('controller/fav/getFav.php').then(response => {
                commit('generateFavList', response.data);
            }).catch(error => console.log(error));
        },
    }
});

export default store