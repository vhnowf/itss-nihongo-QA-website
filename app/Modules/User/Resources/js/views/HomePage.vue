<template>
  <div class="home-page">
    <div class="container">
      <div class="masthead">
        <div class="col">
            <h1 class="column text1">A public platform building the definitive collection of coding questions & answers</h1>
            <hr class="divider" />
        </div>
        <div>
            <p class="text2">A community-based space to find and contribute answers to technical challenges, and one of the most popular websites in the world.</p>
            <a class="btn" href="#about">Find Out More</a>
        </div>
      </div>
      <section class="page-section" id = "services">
        <div class="container">
            <h2 class="text3">At Your Service</h2>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col1">
                    <div class="mt-5">
                        <svg class = "icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M485.5 0L576 160H474.9L405.7 0h79.8zm-128 0l69.2 160H149.3L218.5 0h139zm-267 0h79.8l-69.2 160H0L90.5 0zM0 192h100.7l123 251.7c1.5 3.1-2.7 5.9-5 3.3L0 192zm148.2 0h279.6l-137 318.2c-1 2.4-4.5 2.4-5.5 0L148.2 192zm204.1 251.7l123-251.7H576L357.3 446.9c-2.3 2.7-6.5-.1-5-3.2z"></path></svg>
                        <h3 >Increase productivity</h3>
                        <p class="text-muted">Knowledge is reused and collaboration happens asynchronously, especially crucial in a remote, fully-distributed environment.</p>
                    </div>
                </div>
                <div class="col1">
                    <div class="mt-5">
                        <svg class = "icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M255.03 261.65c6.25 6.25 16.38 6.25 22.63 0l11.31-11.31c6.25-6.25 6.25-16.38 0-22.63L253.25 192l35.71-35.72c6.25-6.25 6.25-16.38 0-22.63l-11.31-11.31c-6.25-6.25-16.38-6.25-22.63 0l-58.34 58.34c-6.25 6.25-6.25 16.38 0 22.63l58.35 58.34zm96.01-11.3l11.31 11.31c6.25 6.25 16.38 6.25 22.63 0l58.34-58.34c6.25-6.25 6.25-16.38 0-22.63l-58.34-58.34c-6.25-6.25-16.38-6.25-22.63 0l-11.31 11.31c-6.25 6.25-6.25 16.38 0 22.63L386.75 192l-35.71 35.72c-6.25 6.25-6.25 16.38 0 22.63zM624 416H381.54c-.74 19.81-14.71 32-32.74 32H288c-18.69 0-33.02-17.47-32.77-32H16c-8.8 0-16 7.2-16 16v16c0 35.2 28.8 64 64 64h512c35.2 0 64-28.8 64-64v-16c0-8.8-7.2-16-16-16zM576 48c0-26.4-21.6-48-48-48H112C85.6 0 64 21.6 64 48v336h512V48zm-64 272H128V64h384v256z"></path></svg>
                        <h3 >Accelerate time to market</h3>
                        <p class="text-muted">Less distractions and duplication of effort means your team can concentrate on shipping.</p>
                    </div>
                </div>
                <div class="col1">
                    <div class="mt-5">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M336.5 160C322 70.7 287.8 8 248 8s-74 62.7-88.5 152h177zM152 256c0 22.2 1.2 43.5 3.3 64h185.3c2.1-20.5 3.3-41.8 3.3-64s-1.2-43.5-3.3-64H155.3c-2.1 20.5-3.3 41.8-3.3 64zm324.7-96c-28.6-67.9-86.5-120.4-158-141.6 24.4 33.8 41.2 84.7 50 141.6h108zM177.2 18.4C105.8 39.6 47.8 92.1 19.3 160h108c8.7-56.9 25.5-107.8 49.9-141.6zM487.4 192H372.7c2.1 21 3.3 42.5 3.3 64s-1.2 43-3.3 64h114.6c5.5-20.5 8.6-41.8 8.6-64s-3.1-43.5-8.5-64zM120 256c0-21.5 1.2-43 3.3-64H8.6C3.2 212.5 0 233.8 0 256s3.2 43.5 8.6 64h114.6c-2-21-3.2-42.5-3.2-64zm39.5 96c14.5 89.3 48.7 152 88.5 152s74-62.7 88.5-152h-177zm159.3 141.6c71.4-21.2 129.4-73.7 158-141.6h-108c-8.8 56.9-25.6 107.8-50 141.6zM19.3 352c28.6 67.9 86.5 120.4 158 141.6-24.4-33.8-41.2-84.7-50-141.6h-108z"></path></svg>
                        <h3 >Protect institutional knowledge</h3>
                        <p class="text-muted">Information is not locked away in specific people or teams, so there is a historical record.</p>
                    </div>
                </div>
              
            </div>
        </div>
      </section>
    </div>
   </div>
</template>

<script>

export default {
  name: "home-page",
  data() {
    return {
    };
  },
  // props: {
  //   banners: {
  //     type: Array,
  //     required: true,
  //   },
  //   categoryCompanies: {
  //     type: Array,
  //     required: true,
  //   },
  //   categories: {
  //     type: Array,
  //     required: true,
  //   }
  // },
  created: function () {
    if (!this.$store.getters.isLoggedIn) {
      let searchParams = new URLSearchParams(window.location.search);
      if (searchParams.get("login")) {
        showPopupUser("login");
      }
    }
  },
  methods: {
  },
};
</script>
<style scoped lang="scss">
  .row {
      display: flex;
      flex-wrap: wrap;
      
      justify-content: center !important;
  /*     
      align-items: center !important;
      text-align: center !important;
      height: 100% !important; */
  }
  .masthead {
    padding-top: 2rem;
    padding-bottom: 16rem;     
    text-align: center;
    color: #fff;
    background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%);
    background-image: url(/images/stack.png);
    background-repeat: no-repeat;
    background-attachment: scroll;
    background-position: center center;
    background-size: cover; 
  }
</style>
