<template>
  <div id="app">
   <h1>{{getTest}}</h1>

     <div class="wrapper">
        <app-sidebar @changeTab="changeTab"></app-sidebar>

        <transition name="component-fade" mode="out-in">
           <keep-alive>
              <component v-bind:is="currentTab"></component>
           </keep-alive>
        </transition>


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
        this.$store.dispatch('getFavorite');
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
   .component-fade-enter-active, .component-fade-leave-active {
      transition: opacity .3s ease;
   }
   .component-fade-enter, .component-fade-leave-to  {
      opacity: 0;
   }
</style>
