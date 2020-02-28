<template>
    <div id="me">
         <div class="container">
      <h3>About Me</h3>
      <div class="message" v-html="message" v-if="message"></div>
    </div>
    </div>
</template>
<script>
export default {
    name:'me',
    data() {
      return {
         url: "https://blog.sdrexx-xyx.cn/api/",
         message:null,
      }
    },
    beforeMount() {
    let that = this;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", that.url + "getAbout.php", true);
    xhr.send();
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          that.message=JSON.parse(xhr.responseText).msg.message
           
        }
      }
    };
  },
}
</script>
<style scoped>
#me {
    padding: 48px 0;
}
.container {
  padding: 0 15px;
  margin: 0 auto;
}
.container h3 {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 8px;
}
.container {
  max-width: 820px;
}
@media (max-width: 1200px) {
  .container {
    max-width: 1140px;
  }
}
@media (max-width: 992px) {
  .container {
    max-width: 960px;
  }
   #me {
    padding: 28px;
  }
}
@media (max-width: 768px) {
  .container {
    max-width: 720px;
  }
  #me {
    padding: 18px;
  }
}
@media (max-width: 576px) {
  .container {
    max-width: 540px;
  }
  #me {
    padding: 8px;
  }
}

</style>