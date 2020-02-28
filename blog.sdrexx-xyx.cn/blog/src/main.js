import Vue from 'vue'
import App from './App.vue'
import router from './router'
import 'font-awesome/scss/font-awesome.scss'
Vue.config.productionTip = false
Vue.prototype.resetSetItem = function (key, newVal) {
  if (key === 'watchStorage') {

      // 创建一个StorageEvent事件
      var newStorageEvent = document.createEvent('StorageEvent');
      const storage = {
          setItem: function (k, val) {
              sessionStorage.setItem(k, val);

              // 初始化创建的事件
              newStorageEvent.initStorageEvent('setItem', false, false, k, null, val, null, null);

              // 派发对象
              window.dispatchEvent(newStorageEvent)
          }
      }
      return storage.setItem(key, newVal);
  }
}


new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
