<template>
  <div class="app">
    <nav :class="change">
      <div class="title">
        <i class="fa fa-align-justify" @click="Navchange"></i>
        <h1>sdrexx的博客</h1>
      </div>
      <div class="hearer" v-show="navshow">
        <div class="userinfo">
          <img src="./assets/timg.jpg" alt />
          <p>欢迎来到我的博客，你可以通过abou了解更多关于我的信息</p>
          <router-link to="/me">Find out more about me</router-link>
        </div>
        <div class="line"></div>
        <ul class="list">
          <li v-for="(item,index) in items" :key="index" :class="index==idx?'hover':''">
            <div @click="topath(item.path,index)">
              <i :class="item.icon"></i>
              <span>{{item.title}}</span>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <div class="main">
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
export default {
  name: "app",
  data() {
    return {
      navshow: true,
      items: [
        { title: "Blog Home ", icon: "fa fa-home", path: "/" },
        { title: "Blog Post", icon: "fa fa-bookmark", path: "/post/0" },
        { title: "About Me", icon: "fa fa-user", path: "/me" }
      ],
      change: "nowchange",
      idx: 0,
    };
  },
  methods: {
    Navchange() {
      this.change == "nowchange"
        ? (this.change = "change")
        : (this.change = "nowchange");
      if (this.navshow == false) {
        setTimeout(() => {
          this.navshow = true;
        }, 300);
      } else {
        this.navshow = false;
      }
    },
    topath(val, index) {
      if (document.body.offsetWidth < 991) {
        this.navshow = false;
        this.change = "change";
      }
      this.$router.push({ path: val });
      this.resetSetItem("watchStorage", index);
    }
  },
  beforeMount() {
     this.resetSetItem("watchStorage", 0);
    if (document.body.offsetWidth < 991) {
      this.navshow = false;
      this.change = "change";
    }
    window.addEventListener("setItem", () => {
      this.idx = sessionStorage.getItem("watchStorage");
    });
  }
};
</script>
<style scoped>
* {
  padding: 0px;
  margin: 0px;
}
nav {
  position: fixed;
  left: 0;
  top: 0;
  bottom: 0;
  width: 248px;
  height: 100%;
  background: #5fcb71;
  color: white;
  padding: 16px;
}
.title {
  display: flex;
  align-items: center;
}
.title i {
  display: none;
  cursor: pointer;
  font-size: 18px;
}
nav h1 {
  text-align: center;
  width: 100%;
  font-weight: 700;
}
.userinfo {
  text-align: center;
  margin-top: 32px;
}
.userinfo img {
  width: 160px;
  border-radius: 50%;
}
.userinfo p {
  font-size: 14px;
  color: rgba(255, 255, 255, 0.8);
}
.userinfo a {
  color: rgba(255, 255, 255, 0.8);
  text-align: center;
  font-size: 14px;
}
nav .line {
  height: 1px;
  width: 90%;
  background: rgba(0, 0, 0, 0.1);
  margin: 0 auto;
  margin-top: 10px;
  margin-bottom: 10px;
}
.list {
  padding: 0;
  margin: 0;
  list-style: none;
  text-align: center;
}
.list li {
  padding: 8px;
}
.list div {
  display: flex;
  align-items: center;
  text-decoration: none;
  margin-left: 60px;
  color: rgba(255, 255, 255, 0.8);
  cursor: pointer;
  font-weight: 700;
}
.list div:hover {
  color: rgba(0, 0, 0, 0.6);
}
.list div span:hover {
  text-decoration: underline;
  color: rgba(0, 0, 0, 0.6);
}
.list .hover i {
  color: rgba(0, 0, 0, 0.6);
}
.list .hover span {
  color: rgba(0, 0, 0, 0.6);
}
.list i {
  display: block;
  width: 16px;
  height: 16px;
  margin-right: 8px;
}
.main {
  margin-left: 280px;
}
@media screen and (max-width: 991px) {
  nav {
    box-sizing: border-box;
    position: static;
    width: 100%;
    transition: all 0.3s ease-in;
  }
  .change {
    height: 63px;
  }
  .nowchange {
    height: 431px;
  }
  .main {
    margin-left: 0px;
  }
  .title i {
    display: block;
  }
  .list div {
    margin-left: 0px;
    font-weight: normal;
  }
  nav .line {
    margin-top: 6px;
    margin-bottom: 6px;
  }
}
</style>
