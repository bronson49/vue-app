import Vue from 'vue'
import Vuex from 'vuex';
import axios from 'axios'

Vue.use(Vuex);

const store = new Vuex.Store({
    state:{
        test : 'my films',
        watchList:[],
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
        }
    }
});

export default store