<template>
  <div id="app">
    <div class="login" v-if="isLogin">
      <div @click.once="clickCount==0?clickCount++:clickCount--" class="btn"></div>
      <div @click.once="clickCount==1?clickCount++:clickCount--" class="btn"></div>
      <div @click.once="clickCount==2?clickCount++:clickCount--" class="btn"></div>
      <div @click.once="clickCount==3?clickCount++:clickCount--" class="btn"></div>
    </div>
    <div class="main" v-else>
      <div class="search">
        <div class="baidu">
          <input type="text" placeholder="百度-搜索输入搜索内容" v-model="BsearchVal" />
          <button class="btn-animate" @click="BaiduSearch">BaiDu</button>
        </div>
        <div class="google">
          <input type="text" placeholder="谷歌-输入搜索内容" v-model="GsearchVal" />
          <button class="btn-animate" @click="GoogleSearch">Google</button>
        </div>
      </div>
      <div class="list">
        <lists></lists>
      </div>
    </div>
  </div>
</template>

<script>
import lists from "./components/lists";
export default {
  name: "app",
  data() {
    return {
      isLogin: true,
      clickCount: 0,
      BsearchVal: "",
      GsearchVal: ""
    };
  },
  methods: {
    BaiduSearch() {
      window.open("http://www.baidu.com/s?wd=" + this.BsearchVal);
    },
    GoogleSearch() {
      window.open("https://www.google.com/search?q=" + this.GsearchVal);
    }
  },
  components: {
    lists
  },
  watch: {
    clickCount() {
      if (this.clickCount == 4) {
        this.isLogin = false;
        localStorage.setItem("login", 1);
      }
    }
  },
  created() {
    let _this = this;
    document.onkeydown = function(e) {
      var keycode = document.all ? event.keyCode : e.which;
      if (keycode == 13) {
        if (_this.BsearchVal != "") {
          window.open("http://www.baidu.com/s?wd=" + _this.BsearchVal);
        } else if (_this.GsearchVal != "") {
          window.open("https://www.google.com/search?q=" + _this.GsearchVal);
        }
      }
    };
  },
  beforeMount() {
    if (
      localStorage.getItem("login") ||
      localStorage.getItem("login") == 1
    ) {
      this.isLogin = false;
    }
  }
};
</script>

<style>
.login {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}
.btn {
  width: 100px;
  height: 60px;
  background: white;
  position: fixed;
}
.login div:nth-child(1) {
  top: 0;
  left: 0;
}
.login div:nth-child(2) {
  bottom: 0;
  right: 0;
}
.login div:nth-child(3) {
  right: 0;
  top: 0;
}
.login div:nth-child(4) {
  bottom: 0;
  left: 0;
}
.search {
  margin-top: 20%;
  text-align: center;
}
.baidu {
  margin-bottom: 40px;
}
.search input {
  width: 50%;
  height: 34px;
  border: 1px solid #b6b6b6;
  border-color: #7b7b7b #b6b6b6 #b6b6b6 #7b7b7b;
  background: #fff;
  display: inline-block;
  vertical-align: top;
  margin-right: 0;
  border-color: #b8b8b8 transparent #ccc #b8b8b8;
  overflow: hidden;
  padding: 0px;
  padding-left: 14px;
  opacity: .8;
}
.btn-animate {
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 2px;
    cursor: pointer;
    position: relative;
    padding: 15px 30px;
    border: none;
    border-radius: 4px;
    box-shadow: 0px 16px 47px -15px #590b9b;
    background: none;
    -webkit-transition: all 0.2s cubic-bezier(0.19, 1, 0.22, 1);
    transition: all 0.2s cubic-bezier(0.19, 1, 0.22, 1);
    border-radius: 8px;
    overflow: hidden;
    outline: none;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
}
.btn-animate span {
    position: relative;
    z-index: 2;
}
.btn-animate:before,
.btn-animate:after {
    content: '';
    z-index: -1;
    background: -webkit-linear-gradient(350deg, #560a9b, #9e158f);
    background: linear-gradient(100deg, #560a9b, #9e158f);
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.btn-animate:after {
    background: -webkit-linear-gradient(350deg, #003f77, #05c4b5);
    background: linear-gradient(100deg, #003f77, #05c4b5);
    -webkit-transform: scaleY(0);
    transform: scaleY(0);
    -webkit-transform-origin: top;
    transform-origin: top;
    -webkit-transition: -webkit-transform 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    transition: -webkit-transform 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    transition: transform 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    transition: transform 0.5s cubic-bezier(0.19, 1, 0.22, 1), -webkit-transform 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    -webkit-transition-delay: .1s;
    transition-delay: .1s;
}
.btn-animate:hover {
    box-shadow: 0px 16px 47px -15px #003f77;
}
.btn-animate:hover:after {
    -webkit-transform: scaleY(1);
    transform: scaleY(1);
    -webkit-transform-origin: bottom;
    transform-origin: bottom;
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
}
.btn-animate:active {
    -webkit-transform: translateY(4px) translateZ(0);
    transform: translateY(4px) translateZ(0);
    box-shadow: 0px 8px 10px -6px #003f77;
}
.search button {
  width: 100px;
  height: 36px;
  color: #fff;
  font-size: 15px;
  letter-spacing: 1px;
  background: #3385ff;
  border-bottom: 1px solid #2d78f4;
  outline: medium;
  -webkit-appearance: none;
  border: none;
  cursor: pointer;
  opacity: .8;
  line-height:2px;
  text-align: left;
  border-bottom-left-radius: 0px;
  border-top-left-radius: 0px;
}

body {
  background-size: 100% 100%;
  background-repeat: no-repeat;
  height: 100%;
  width: 100%;
  overflow: hidden;
  background-size: cover;
}
@media screen and (min-width: 1024px) {
  body {
    background-image: url("http://api.btstu.cn/sjbz/?lx=dongman");
  }
}
@media screen and (max-width: 900px) {
  body {
    padding: 0px;
    margin: 0;
    background-image: url("http://api.btstu.cn/sjbz/?lx=m_dongman");
  }
}
</style>
