<template>
  <div id="app">
    <el-container >
      <el-aside width="64px" style="background-color: rgb(238, 241, 246)">
        <el-menu
          default-active="1"
          class="el-menu-vertical-demo"
          @open="handleOpen"
          @close="handleClose"
          background-color="#545c64"
          text-color="#fff"
          active-text-color="#ffd04b"
          :collapse="collapse"
        >
        <el-menu-item index="1"  @click="$router.replace({path:'/'})">
            <i class="el-icon-menu"></i>
            <span slot="title">首页</span>
          </el-menu-item>
          <el-submenu index="2">
            <template slot="title">
              <i class="el-icon-edit"></i>
              <span>博文</span>
            </template>
            <el-menu-item-group >
              <template slot="title">博文操作</template>
              <el-menu-item index="1-1"  @click="$router.replace({path:'/blogMessage'})">
                  博文编辑
              </el-menu-item>
            </el-menu-item-group>
          </el-submenu>
          <el-menu-item index="3"  @click="$router.replace({path:'/About'})">
            <i class="el-icon-tickets"></i>
            <span slot="title">个人介绍</span>
          </el-menu-item>
        </el-menu>
      </el-aside>

      <el-container>
        <el-header style="text-align: right; font-size: 12px">
          <el-dropdown>
            <i class="el-icon-setting" style="margin-right: 15px"></i>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item ><a href="https://blog.sdrexx-xyx.cn">返回博客</a></el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
          <span>欢迎徐宇星！</span>
        </el-header>

        <el-main>
          <router-view></router-view>
        </el-main>
      </el-container>
    </el-container>
  </div>
</template>

<script>
export default {
  name: "app",
  data() {
    return {
      collapse:true
    };
  },
  methods: {
    handleOpen(key, keyPath) {
      window.console.log(key, keyPath);
    },
    handleClose(key, keyPath) {
      window.console.log(key, keyPath);
    }
  }
};
</script>

<style scoped>
/deep/.el-header {
  background-color: #b3c0d1;
  color: #333;
  line-height: 60px;
}

/deep/ .el-aside {
  color: #333;
}
/deep/ .el-container {
  height: 100vh;
}
/deep/ .el-menu {
  height: 100%;
  border-right: none;
}
/deep/ .el-menu-vertical-demo:not(.el-menu--collapse) {
  width: 200px;
  min-height: 400px;
}
.el-dropdown-menu__item a {
  text-decoration: none;
  color: #333;
}

</style>
