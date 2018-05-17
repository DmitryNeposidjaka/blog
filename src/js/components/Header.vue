<template>
    <el-header>
        <div id="homeButton" @click="animateHomeB" title="На главную">
            <div class="element-button">
                <div class="element-button-input type1"></div>
            </div>
            <div class="element-button">
                <div class="element-button-input type2"></div>
            </div>
            <div class="element-button">
                <div class="element-button-input type3"></div>
            </div>
            <div class="element-button">
                <div class="element-button-input type4"></div>
            </div>
            <div class="element-button">
                <div class="element-button-input type5"></div>
            </div>
            <div class="element-button">
                <div class="element-button-input type6"></div>
            </div>
            <div class="clf"></div>
        </div>
        <div class="logo-block">
            <span class="logo-text">The BLOG</span>
        </div>

    </el-header>
</template>

<script>
    import anime from 'animejs';
    import ElRow from "element-ui/packages/row/src/row";
export default {
  data(){
    return {
      animateIn: false,
    }
  },
  methods: {
    animateHomeB(){
      const vm = this;
      var penner = anime.timeline();
      let translate = 0;
      let translateLast = 0;
      let translateFirst = 0;
      if(this.animateIn){
        this.animateIn = false;
      }else {
        translate = 170;
        translateLast = 170 - 25;
        translateFirst = 170 + 25;
        this.animateIn = true;
      }
      penner
        .add({
          targets: '#homeButton .type1', translateX: translateFirst, offset: 0,
          easing: 'easeInQuart'
        })
        .add({
          targets: '#homeButton .type2', translateX: translate, offset: 0,
          easing: 'easeInQuad'
        })
        .add({
          targets: '#homeButton .type3', translateX: translate, offset: 0,
          easing: 'easeInCubic'
        })
        .add({
          targets: '#homeButton .type4', translateX: translate, offset: 0,
          easing: 'linear'
        })
        .add({
          targets: '#homeButton .type5', translateX: translate, offset: 0,
          easing: 'easeInQuint'
        })
        .add({
          targets: '#homeButton .type6', translateX: translateLast, offset: 0,
          easing: 'easeInSine'
        }).finished.then(goHome);


      function goHome() {
        vm.$router.push('/')
      }
    }
  },
  components: {ElRow},
  mounted(){
    anime({
      targets: 'svg path',
      strokeDashoffset: [anime.setDashoffset, 0],
      easing: 'easeInOutSine',
      duration: 1500,
      delay: function(el, i) { return i * 250 },
      direction: 'alternate',
      loop: true
    });
  }
}
</script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Righteous');
.logo-text{
    color: azure;
    font-size: 24px;
    font-weight: bold;
    font-family: 'Righteous', cursive;
}
.logo-block{
    width: 200px;
    height: 20px;
    position: absolute;
    right: 20px;
    top: 10px;
    z-index: 5;
}
    #homeButton{
        width: 200px;
        height: 100%;
        background: #ffffff;
        margin: 0px 0px 0px 40px;
    }
    .element-button{
        width: 5px;
        height: 100%;
        float: left;
    }
    .clf{
        clear: both;
    }
    .element-button-input{
        width: 100%;
        height: 100%;
        background: #fff;
    }
    .type1{
        background: #333;
    }
    .type2{
        background: #333;
    }
    .type3{
        background: #333;
    }
    .type4{
        background: #333;
    }
    .type5{
        background: #333;
    }
    .type6{
        background: #ffeb3b;
    }
</style>