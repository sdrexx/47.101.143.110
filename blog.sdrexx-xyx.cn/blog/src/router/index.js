import Vue from 'vue'
import VueRouter from 'vue-router'
import home from '../views/Home.vue'
import me from '../views/Me.vue'
import post from '../views/Post.vue'
const routerPush = VueRouter.prototype.push
VueRouter.prototype.push = function push(location) {
  return routerPush.call(this, location).catch(error=> error)
}

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: home,
  },
  {
    path:'/me',
    name:'me',
    component: me
  },
  {
    path: '/post/:id',
    name: 'post',
    component:post
  },
  
]

const router = new VueRouter({
  mode:'history',
  routes
})
router.onError((error) => {
  const pattern = /Loading chunk (\d)+ failed/g;
  const isChunkLoadFailed = error.message.match(pattern);
  const targetPath = router.history.pending.fullPath;
  if (isChunkLoadFailed) {
    router.replace(targetPath);
  }
});

export default router
