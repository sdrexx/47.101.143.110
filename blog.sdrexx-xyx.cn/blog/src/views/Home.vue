<template>
  <div id="home">
    <section></section>
    <div class="list">
      <ul class="container">
        <li v-for="(item,index) in messageNow" :key="index">
          <img :src="item.previewimg" />
          <div class="body">
            <span
              @click="toMessage(item.id,item.click,item.data)"
              class="title"
            >{{item.title}}</span>
            <div class="data">
              <span @click="toMessage(item.id,item.click,item.data)">{{item.data | getLocalTime}}</span>
              <span @click="toMessage(item.id,item.click,item.data)">{{item.click | setnumber}}浏览</span>
            </div>
            <div class="message" v-html="item.previewmes"></div>
          </div>
          <span @click="toMessage(item.id,item.click,item.data)" class="more">Read more →</span>
        </li>
        <div class="blog-nav">
          <span v-show="next" @click="getUpInfo">
            <i class="fa fa-arrow-left"></i>
            上一页
          </span>
          <span :class="once" @click="getNextInfo" v-show="up">
            下一页
            <i class="fa fa-arrow-right"></i>
          </span>
        </div>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "home",
  data() {
    return {
      next: false,
      up: true,
      once: "onlyone",
      url: "https://blog.sdrexx-xyx.cn/api/",
      messageNow: [],
      messageCount: [],
      messageOrder: [],
      key: 0
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
    // 过滤器 将时间戳换算成过去周、时、分、
    setnumber(number) {
      return new Number(number);
    }
    // 将字符转换成数字
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
          for (let i = 0; i < that.messageCount.length; i++) {
            that.messageCount[i].id = i;
          }
          for (var i = 0; i < that.messageCount.length; i += 3) {
            that.messageOrder.push(that.messageCount.slice(i, i + 3));
          }
          that.messageNow = that.messageOrder[that.key];
        }
      }
      // 获取所有文章放到变量 messageCount 中， 将 messageCount 排序以3个为一组划分放到变量 messageOrder 中，将二维数组变量 messageOrder 的第一个值赋值给 messageNow
    };
  },
  methods: {
    getUpInfo() {
      if (this.key > 0) {
        this.key--;
        this.messageNow = this.messageOrder[this.key];
        this.up = true;
        this.next = true;
      }
      if (this.key == 0) {
        this.next = false;
        this.up = true;
      }
    },
    /* 上一页按钮效果实现*/
    getNextInfo() {
      if (this.key < this.messageOrder.length - 1) {
        this.key++;
        this.next = true;
        this.up - true;
        this.messageNow = this.messageOrder[this.key];
      }
      if (this.key == this.messageOrder.length - 1) {
        this.up = false;
      }
    },
    /* 下一页按钮效果实现 */
    toMessage(index, click, data) {
      let number = new Number(click) + 1;
    
      var xhr = new XMLHttpRequest();
      xhr.open("POST", this.url + "changeClick.php", true);
      var forms = new FormData();
      forms.append("click", number);
      forms.append("redata", data);
      xhr.send(forms);
      
      this.resetSetItem("watchStorage", 1);
      this.$router.push({ path: "/post/" + index });
    }
    /* 跳转至选择详情页 */
  }
};
</script>
<style scoped>
section {
  height: 168px;
  padding: 48px 0px;
  background: #fafafa;
}
.list {
  padding: 48px;
}
.container {
  padding: 0px 15px;
  margin: 0 auto;
  list-style: none;
  max-width: 882px;
}
.container li {
  display: flex;
  position: relative;
  margin-bottom: 30px;
}
.container li img {
  display: block;
  width: 110px;
  height: 110px;
  margin-right: 16px;
}
.body .title {
  text-decoration: none;
  color: #222;
  cursor: pointer;
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 5px;
}
.body .title:hover {
  text-decoration: underline;
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
.message p {
  margin: 0;
  font-size: 14px;
}
.message p {
  height: 57px;
  text-overflow: ellipsis;
  overflow: hidden;
}
.more {
  position: absolute;
  color: #5fcb71;
  font-size: 13px;
  bottom: -20px;
  left: 126px;
  text-decoration: none;
  cursor: pointer;
}
.more:hover {
  text-decoration: underline;
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
@media screen and (max-width: 771px) {
  .container li img {
    display: none;
  }
  .list {
    padding: 48px 16px;
  }
  .more {
    left: 0;
  }
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
}
@media (max-width: 768px) {
  .container {
    max-width: 720px;
  }
}
@media (max-width: 576px) {
  .container {
    max-width: 540px;
  }
}
</style>