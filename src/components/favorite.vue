<template>
   <div class="tab-wrapper">
      <h1>favorite component</h1>
      <p v-for="(item, index) in favList" :key="index">
         {{item.title}}
      </p>
   </div>
</template>

<script>
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
    }
</script>

<style scoped>

</style>