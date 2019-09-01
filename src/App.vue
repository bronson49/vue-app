<template>
  <div id="app">
   <h1>{{getTest}}</h1>

     <div class="wrapper">
        <app-sidebar @changeTab="changeTab"></app-sidebar>

        <keep-alive>
        <component v-bind:is="currentTab"></component>
        </keep-alive>

     </div>
  </div>
</template>

<script>
   import sidebar from './components/sidebar'
   import search from './components/search'
   import watch from './components/watch'
   import favorite from './components/favorite'
   import viewed from './components/viewed'

export default {
  name: 'app',
    data(){
        return{
            currentTab : 'app-search',
        }
    },
    beforeMount(){
        this.$store.dispatch('getToWatch');
    },
  components: {
      appSidebar:sidebar,
      appSearch: search,
      appWatch: watch,
      appFavorite: favorite,
      appViewed: viewed,
  },
  computed : {
    getTest(){
       return this.$store.state.test
    }
  },
    methods: {
      changeTab (tab){
          this.currentTab = tab;
      },
    },
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
