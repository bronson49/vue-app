import Vue from 'vue'
import App from './App.vue'

import store from './store/store'

import styles from './styles/base.scss'

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
    store,

}).$mount('#app')
