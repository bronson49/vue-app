<template>
   <div class="sidebar-wrapper">
      <div
         v-for="tab in tabsList"
         @click="changeTab(tab.id)"
      >{{tab.title}}</div>
   </div>
</template>

<script>
    export default {
        name: "sidebar",
        data(){
          return{
              tabsList: [
                  {id:'app-search', title:'Поиск'},
                  {id:'app-watch', title:'Хочу посмотреть'},
                  {id:'app-favorite', title:'Избранное'},
                  {id:'app-viewed', title:'Просмотренное'},
              ]
          }
        },

        methods:{
            changeTab(tabName){
              this.$emit('changeTab', tabName)
            },
        },
    }
</script>