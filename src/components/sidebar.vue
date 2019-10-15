<template>
   <div class="sidebar-wrapper" @wheel.prevent="wheelRotate($event)">
      <div
         class="sidebar-item"
         v-for="(tab, index) in tabsList" :key="index"
         @click="changeTab(tab.id, index)"
         :style="currRotate(index)"
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

        computed:{
            activeTabIndex(){
                return this.$store.state.activeTabIndex;
            }
        },
        methods:{
            currRotate(selfIndex){
                let StyleObj = {};
                const activeIndex = this.activeTabIndex;
                const rotateStep = this.$store.state.rotateStep;
                const rotate = (selfIndex * rotateStep)-(activeIndex * rotateStep)  ;
                StyleObj.transform = 'rotate('+rotate+'deg)';
                if (activeIndex === selfIndex) {
                    StyleObj.backgroundImage = 'linear-gradient(90deg,transparent 70%, '+this.randomRGBA(0.4)+' 100%)';
                    StyleObj.backgroundPosition= '100% 50%';
                    StyleObj.paddingRight = '15px';
                }

                return StyleObj
            },
            changeTab(tabName, index){
                this.$emit('changeTab', tabName);
                this.$store.commit('rotateTabList', index)
            },
            wheelRotate(event){
                if (event.deltaY > 0 && this.activeTabIndex < this.tabsList.length-1){
                    this.$store.commit('rotateTabList', this.activeTabIndex+1);
                }
                if (event.deltaY < 0 && this.activeTabIndex > 0){
                    this.$store.commit('rotateTabList', this.activeTabIndex-1);
                }
                this.$emit('changeTab', this.tabsList[this.activeTabIndex].id);

            },
            randomRGBA(opacity){
                return 'rgba('+this.getRandom(150,255)+', '+this.getRandom(150,255)+', '+this.getRandom(150,255)+', '+opacity+')'
            },
            getRandom(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }
        },
    }
</script>