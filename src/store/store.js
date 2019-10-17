import Vue from 'vue'
import Vuex from 'vuex';
import axios from 'axios'

Vue.use(Vuex);

const store = new Vuex.Store({
    state:{
        test : 'my films',
        watchList:[],
        favList:[],
        activeTabIndex: 0,
        rotateStep:15,
    },
    getters:{

    },
    mutations:{
        addToWatch(state, payload){
            state.watchList.push(payload);
        },
        generateWatchList(state, filmArr){
            state.watchList = filmArr;
        },
        generateFavList(state, filmArr){
            if (Array.isArray(filmArr)){
                state.favList = filmArr;
            }
        },
        rotateTabList(state, index){
            state.activeTabIndex = index;
        },
    },
    actions:{
        addToWatch ({dispatch}, filmOpt){
            axios({
                    method: 'POST',
                    url: 'controller/addWatch.php',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    data: filmOpt
            })
            .then(() => {
                dispatch('getToWatch');
            })
            .catch(error => console.log(error));
        },
        getToWatch({commit}){
            axios.get('controller/getWatch.php').then(response => {
                commit('generateWatchList', response.data);
            }).catch(error => console.log(error));
        },

        addFavorite ({dispatch}, filmOpt){
            axios({
                method: 'POST',
                url: 'controller/addFav.php',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                data: filmOpt
            })
                .then(() => {
                    dispatch('getFavorite');
                })
                .catch(error => console.log(error));
        },
        getFavorite({commit}){
            axios.get('controller/getFav.php').then(response => {
                commit('generateFavList', response.data);
            }).catch(error => console.log(error));
        },
    }
});

export default store