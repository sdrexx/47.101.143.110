<template>
  <div class="add">
    <div id="dialog-title">添加快捷方式</div>
    <div id="title" class="field-container">
      <label id="title-field-name" class="field-title" aria-label="名称">名称</label>
      <div class="input-container">
        <input
          id="title-field"
          class="field-input"
          type="text"
          autocomplete="off"
          tabindex="0"
          v-model="title"
        />
        <div class="underline"></div>
      </div>
    </div>
    <div id="url" class="field-container">
      <label id="url-field-name" class="field-title" aria-label="网址">网址</label>
      <div class="input-container">
        <input
          id="url-field"
          class="field-input"
          type="text"
          autocomplete="off"
          spellcheck="false"
          dir="ltr"
          tabindex="0"
          v-model="url"
        />
      </div>
    </div>
    <div class="agree">
      <button @click="addinfo">完成</button>
      <button @click="quit">关闭</button>
    </div>
  </div>
</template>
<script>
export default {
  name: "add",
  data() {
    return {
      title: "",
      url: "",
      show:false,
    };
  },
  methods: {
    addinfo() {
      let data = new FormData();
      data.append("title", this.title);
      data.append("url", this.url);
      if (this.title != "" && this.url != "") {
        this.axios.post("../api/Adduser.php", data).then(res => {
          window.console.log(res)
          this.title="";
          this.url="";
        });
      }
      
    },
    quit(){
      this.$emit("changeShow",this.show)
    }
  }
};
</script>
<style scoped>
.add {
  position: fixed;
  top: 0;
  background-color: #fff;
  border: none;
  border-bottom-left-radius: 8px;
  border-bottom-right-radius: 8px;
  box-shadow: 0 1px 3px 0 rgba(60, 64, 67, 0.3),
    0 4px 8px 3px rgba(60, 64, 67, 0.15);
  margin: auto;
  min-width: 320px;
  padding: 16px;
  z-index: 10000;
  box-shadow: 3px 5px 3px 1px rgba(60, 64, 67, 0.8);
}
.dialog-title {
  color: rgb(32, 33, 36);
  font-size: 15px;
  line-height: 24px;
  margin-bottom: 16px;
}
.field-container {
  margin-bottom: 16px;
}
.field-title {
  color: rgb(95, 99, 104);
  font-size: 10px;
  font-weight: 500;
  margin-bottom: 4px;
}
input {
  background-color: rgb(241, 243, 244);
  border: none;
  border-radius: 4px;
  caret-color: rgb(26, 115, 232);
  color: rgb(32, 33, 36);
  font-size: 13px;
  line-height: 1.6;
  min-height: 32px;
  outline: none;
  padding-inline-end: 8px;
  padding-inline-start: 8px;
  width: calc(100% - 16px);
}
.agree button {
  border: none;
  border-radius: 4px;
  font-size: 12px;
  font-weight: 500;
  line-height: 1.6;
  min-height: 32px;
  padding: 0 16px;
  position: relative;
  transition-duration: 200ms;
  transition-property: background-color, color, box-shadow, border;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  background: rgb(26, 115, 232);
  color: white;
  border: none;
  outline: none;
}
.agree button:nth-child(2) {
  margin-left: 18px;
}
</style>