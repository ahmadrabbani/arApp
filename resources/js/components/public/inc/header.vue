<template>
  <header id="header" class="bm" style="125px">
    <div id="top-bar">
      <div class="container-fluid clearfix">
        <div class="row">
          <div class="col-md-8 col-xs-12 bg-brown">
            <ul class="header-extras">
              <li>
                <i class="i-plain icon-call nomargin white"></i>
                <div class="he-text white">
                  Get in Touch
                  <span class="white">1800-1144-551</span>
                </div>
              </li>
              <ul class="nav navbar-nav navbar-right">
                <li>
                  <span class="fas fas-search"></span>
                  <input
                    placeholder="Name des Produkts"
                    type="search"
                    autocomplete="off"
                    v-model="searchKey"
                    name="search"
                    class="form form-control"
                    id="top-search"
                    value=""
                  />
                </li>
              </ul>
            </ul>
          </div>
          <div class="col-md-4 col-xs-12 bg-brown lms">
            <ul class="header-extras">
              <li>
                <i class="i-plain white icon-email3 nomargin"></i>
                <div class="he-text white">
                  Drop an Email
                  <span class="white">info@Alis.com</span>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid clearfix nopadding nomargin">
      <nav id="primary-menu" class="style-2">
        <div id="logo">
          <a href="/" class="standard-logo" data-dark-logo="ashion/images/logo.png">
            <img src="ashion/images/logo.png" alt="Alis Logo"
          /></a>
          <a href="/" class="retina-logo" data-dark-logo="ashion/images/logo.png"
            ><img src="ashion/images/logo.png" alt="Alis Logo"
          /></a>
        </div>
        <div class="container-fluid clearfix nopadding nomargin">
          <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

          <ul class="" style="touch-action: pan-y">
            <li class="" v-for="category in categories" v-bind:key="category">
              <router-link
                :to="`/category/${category.id}`"
                :class="{ 'light-orange': $key % 2 === 0, grn: $key % 2 !== 0 }"
                ><div>
                  <i class="icon-angle-right"></i> {{ category.cat_name }}
                </div></router-link
              >
            </li>
          </ul>
        </div>
      </nav>
      <!-- #primary-menu end -->
      <div class="container-fluid" id="mob-menu">
        <div class="row">
          <div class="col-xs-6 text-center">
            <a href="/" class="retina-logo" data-dark-logo="ashion/images/logo.png"
              ><img src="ashion/images/logo.png" alt="Alis Logo"
            /></a>
          </div>
          <div class="col-xs-6 info text-left">
            <div class="delivery-info-component">
              <div class="opening-time-message closed">
                <i class="icon-time"></i><span> GESCHLOSSEN</span>
              </div>
              <div class="opening-time-message">
                <i class="icon-user"></i><span> Kostenlose Lieferung</span>
              </div>
              <div class="opening-time-message">
                <i class="icon-shopping-cart"></i
                ><span> Mindestbestellwert (15,00 € - 60,00 €)</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid nopadding bg-gray topmargin-sm" id="menu-2">
        <div class="oc-container">
          <div class="oc-item" v-for="category in categories" v-bind:key="category">
            <router-link :to="`/category/${category.id}`">
              {{ category.cat_name }}
            </router-link>
          </div>
        </div>
        <!-- </span> -->
      </div>
    </div>
    

    <div class="clear-fix"></div>
  </header>

  <!-- #header end -->
</template>

<script>
import vue from 'vue';
export default {
  name: "header_area",
  data() {
    return {
      categories: [],
      session: "",
      searchKey: "",
      searchResult: [],
    };
  },
  created() {
    axios.get("/all-category").then((response) => {
      this.categories = response.data;
    });
  },
  mounted() {
    this.$Progress.start();
    this.$store.dispatch("countCart");
    this.$store.dispatch("customerSession");
    this.$store.dispatch("categoryByID", 7);
    this.$store.dispatch("searchProducts", this.searchKey);
    var prevScrollpos = window.pageYOffset;

    this.$Progress.finish();
  },
 
  computed: {
    showCountCart() {
      return this.$store.getters.getCountCart;
    },
    showSession() {
      return this.$store.getters.getSessionData;
    },
  },
  methods: {
    logout() {
      axios.get("user-logout").then((response) => {
        this.$store.dispatch("customerSession");
      });
    },
    getSearchResult(){
      alert(1);
    },
    search() {
      
      
      this.searchResult = this.$store.dispatch("searchProducts", this.searchKey);
      vue.prototype.$SearchArr = this.searchResult;
      console.log(this.searchResult);
    },
  },
  watch: {
    searchKey(after, before) {
      this.search();
    },
  },
};
</script>
