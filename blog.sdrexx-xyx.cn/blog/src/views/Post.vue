<template>
  <div id="post">
    <div class="container" v-if="blogMessage">
      <h3>{{blogMessage.title}}</h3>
      <div class="data">
        <span>{{blogMessage.data | getLocalTime}}</span>
        <span>{{blogMessage.click | setnumber}}次浏览</span>
      </div>
      <div class="message" v-html="blogMessage.message"></div>
      <div class="blog-nav">
        <span v-show="next" @click="getUpInfo">
          <i class="fa fa-arrow-left"></i>
          上一篇
        </span>
        <span :class="once" @click="getNextInfo" v-show="up">
          下一篇
          <i class="fa fa-arrow-right"></i>
        </span>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "post",
  data() {
    return {
      next: false,
      up: true,
      once: "onlyone",
      url: "https://blog.sdrexx-xyx.cn/api/",
      blogMessage: null,
      messageCount: [],
      key: this.$route.params.id
    };
  },
  watch: {
    next(val) {
      if (val == false) {
        this.once = "onlyone";
      } else {
        this.once = "";
      }
    }
  },
  
  filters: {
    getLocalTime(timestamp) {
      // 补全为13位
      var arrTimestamp = (timestamp + "").split("");
      for (var start = 0; start < 13; start++) {
        if (!arrTimestamp[start]) {
          arrTimestamp[start] = "0";
        }
      }
      timestamp = arrTimestamp.join("") * 1;

      var minute = 1000 * 60;
      var hour = minute * 60;
      var day = hour * 24;
      var month = day * 30;
      var now = new Date().getTime();
      var diffValue = now - timestamp;

      // 如果本地时间反而小于变量时间
      if (diffValue < 0) {
        return "不久前";
      }

      // 计算差异时间的量级
      var monthC = diffValue / month;
      var weekC = diffValue / (7 * day);
      var dayC = diffValue / day;
      var hourC = diffValue / hour;
      var minC = diffValue / minute;

      // 数值补0方法
      var zero = function(value) {
        if (value < 10) {
          return "0" + value;
        }
        return value;
      };

      // 使用
      if (monthC > 12) {
        // 超过1年，直接显示年月日
        return (function() {
          var date = new Date(timestamp);
          return (
            date.getFullYear() +
            "年" +
            zero(date.getMonth() + 1) +
            "月" +
            zero(date.getDate()) +
            "日"
          );
        })();
      } else if (monthC >= 1) {
        return parseInt(monthC) + "月前";
      } else if (weekC >= 1) {
        return parseInt(weekC) + "周前";
      } else if (dayC >= 1) {
        return parseInt(dayC) + "天前";
      } else if (hourC >= 1) {
        return parseInt(hourC) + "小时前";
      } else if (minC >= 1) {
        return parseInt(minC) + "分钟前";
      }
      return "刚刚";
    },
    setnumber(number) {
      return new Number(number);
    }
  },
  beforeMount() {
    let that = this;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", this.url + "getMessage.php", true);
    xhr.send();
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          let msg = JSON.parse(xhr.responseText);
          that.messageCount = msg.reverse();
          that.blogMessage = msg[that.$route.params.id];
          if (that.key > 0 && that.key < that.messageCount.length - 1) {
            that.up = true;
            that.next = true;
          } else if (that.key == 0) {
            that.next = false;
            that.up = true;
          } else if (that.key == that.messageCount.length - 1) {
            that.up = false;
          }
        }
      }
    };
  },
  methods: {
    getUpInfo() {
      if (this.key > 0) {
        this.key--;
        this.blogMessage = this.messageCount[this.key];
        this.up = true;
        this.next = true;
      }
      if (this.key == 0) {
        this.next = false;
        this.up = true;
      }
    },
    getNextInfo() {
      if (this.key < this.messageCount.length - 1) {
        this.key++;
        this.next = true;
        this.up = true;
        this.blogMessage = this.messageCount[this.key];
      }
      if (this.key == this.messageCount.length - 1) {
        this.up = false;
      }
    }
  }
};
</script>
<style scopen>
#post {
  padding: 48px;
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
.data span {
  display: inline-block;
  color: rgba(143, 143, 143, 0.8);
  font-size: 13px;
  font-weight: 400;
  cursor: pointer;
}
.data span:hover {
  text-decoration: underline;
  color: #4f4f4f;
}
.data span:first-child::after {
  content: "";
  display: inline-block;
  width: 3px;
  height: 3px;
  border-radius: 50%;
  background: #8f8f8f;
  margin-left: 0.5rem;
  margin-right: 0.5rem;
  position: relative;
  top: -3px;
}

.container {
  max-width: 820px;
}
.blog-nav {
  margin: 48px 0px;
  display: flex;
  align-items: center;
}
.blog-nav span:first-child i {
  position: absolute;
  left: 15px;
  top: 18px;
}
.blog-nav span:last-child i {
  position: absolute;
  right: 15px;
  top: 18px;
}
.blog-nav span {
  background: #5fcb71;
  color: #fff;
  font-size: 16px;
  padding: 16px;
  font-weight: bold;
  position: relative;
  width: 100%;
  text-align: center;
  cursor: pointer;
  position: relative;
}
.message {
  margin-top: 15px;
}
.blog-nav span:first-child {
  border-right: 1px solid #309441;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}
.blog-nav span:last-child {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
.blog-nav span.onlyone {
  border-right: none;
  border-radius: 5px;
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
  #post {
    padding: 28px;
  }
}
@media (max-width: 768px) {
  .container {
    max-width: 720px;
  }
  #post {
    padding: 18px;
  }
}
@media (max-width: 576px) {
  .container {
    max-width: 540px;
  }
  #post {
    padding: 8px;
  }
}
</style>