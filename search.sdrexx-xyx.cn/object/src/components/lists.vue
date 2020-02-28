<template>
  <div class="lists">
    <div class="list" v-for="item in lists" :key="item.id">
      <a :href="'https://'+item.url">
        <img :src="'https://api.ooopn.com/ico/api.php?url=https://'+item.url" alt />
        <p>{{item.title}}</p>
      </a>
    </div>
    <div class="addlist" @click="addlist=true">
      <img src="../static/add_link.svg" alt />
      <p>添加快捷方式</p>
    </div>
    <add v-show="addlist" @changeShow="addlist=false"></add>
  </div>
</template>
<script>
import add from "./add";
export default {
  name: "lists",
  data() {
    return {
      addlist: false,
      lists: []
    };
  },
  components: {
    add
  },
  created() {
    this.axios.get("../api/getuser.php").then(res => {
      window.console.log(res.data);
      this.lists = res.data.msg;
    });
  }
};
</script>
<style scoped>
.lists {
  width: 80%;
  display: flex;
  flex-wrap: wrap;
  position: fixed;
  bottom: 5%;
  justify-content: space-around;
  left: 10%;
}
.list,
.addlist {
  width: 114px;
  height: 114px;
}
.list:hover,
.addlist:hover {
  background: rgba(0, 0, 0, 0.2);
}
.list a {
  display: block;
  width: 100%;
  height: 100%;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  color: black;
  font-weight: bold;
}
.list a img,
.addlist img {
  width: 32px;
  height: 32px;
  margin-top: 30px;
  padding: 6px;
  border-radius: 20%;
  background: rgba(153, 152, 152, 0);
  box-shadow: 0px 3px 3px 2px black;
}
.list a p {
  margin: 0;
  color: #eeeeee;
}
.addlist {
  text-align: center;
}
.addlist p {
  text-align: center;
  font-size: 16px;
  color: #eeeeee;
  font-weight: bold;
  margin: 0;
  margin-top: 5px;
}
</style>