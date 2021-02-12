<template>
  <section id="content">
    <div class="content-wrap">
      <div class="container-fluid clearfix">
        <div id="mobile-home">
          <products></products>
        </div>

        <div class="row bg-white" id="desk-home">
          <div class="col-lg-8 col-md-8">
            <div id="shop" class="shop grid-container clearfix row">
              
              <div
                class="clearfix"
                v-for="(catProduct, index) in showCatProduct"
                v-bind:key="catProduct"
              >
                <div class="clearfix" v-if="index == 0">
                  <div class="cat_image">
                    <img v-bind:src="catProduct.cat_image" class="img-fluid" />
                    <div class="bottom-left img-txt">
                      <h5>{{ catProduct.cat_name }}</h5>
                      
                    </div>
                  </div>
                </div>
                <div>
                  <div style="padding-top: 10px">
                    <div style="border: 1px solid; width: 6%; text-align: center">
                      {{ catProduct.id }}
                    </div>
                    {{ catProduct.product_name }}

                    <button
                      data-toggle="modal"
                      :data-target="
                        catProduct.has_attributes == 1 ? '#myModal' : '#address'
                      "
                      class="bg-brown btn-cart-m"
                      @click.prevent="sendInfo(catProduct.id)"
                    >
                      <span class="plus">+</span
                      ><span style="padding: 0 5px">{{ catProduct.product_price }}</span>
                    </button>
                    <hr />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <cart-section></cart-section>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="address">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">
              <i class="fa fa fa-motorcycle"></i><i class="fa fa-home"></i> Lieferadresse
            </h4>
            <button type="button" class="close" data-dismiss="modal">Ã—</button>
          </div>

          <!-- Modal body -->

          <div class="modal-body">
            <ul class="dilvery">
              <li>
                <label @click="setDelivery()">Liefern</label>
              </li>
              <li><label @click="setDelivery()">Abholen</label></li>
            </ul>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              class="btn btn-app"
              @click.prevent="addToCart(0)"
              v-bind="this.product_id"
            >
              BestÃ¤tigen
            </button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              Abbrechen
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Select One</h4>
            <button type="button" class="close" data-dismiss="modal">Ã—</button>
          </div>

          <!-- Modal body -->

          <div class="modal-body">
            <h5>{{ attributes.name }}</h5>
            <div v-for="option in attributes.options" v-bind:key="option">
              <input type="radio" name="option" class="option" /> {{ option }}
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button
              class="btn btn-app"
              @click.prevent="addToCart(0)"
              v-bind="this.product_id"
            >
              Confirm
            </button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>

export default {
  data() {
    return {
      cat: [],
      attributes: [],
      searchResult:[],
      product_id: 0,
    };
  },
  
  
  mounted() {
    this.$Progress.start();
    this.$store.dispatch("categoryByID", this.$route.params.id);
    this.$store.dispatch("breadcrumb");
    this.$store.dispatch("category");
    this.$store.dispatch("brand");
    // this.searchResult = this.$store.dispatch("searchProducts", this.$SearchQuery);
    this.$Progress.finish();
  },
  
  methods: {
    gProduct() {
      this.$store.dispatch("categoryByID", this.$route.params.id);
    },
    sendInfo(id) {
      console.log(id);
      this.product_id = id;
      console.log(this.product_id);
      this.$Progress.start();
      axios
        .post("/get-attributes", {
          id: this.product_id,
        })
        .then((response) => {
          this.attributes = response.data;
          console.log(this.attributes);
          // this.$Progress.finish();
          this.$Progress.finish();
        });
    },
    setDelivery: function () {
      document
        .querySelectorAll("label")
        .forEach((el) => el.classList.remove("selectedDelivery"));

      event.target.classList.toggle("selectedDelivery");
    },
    addToCart(id) {
      this.$Progress.start();
      axios
        .post("/add-cart", {
          id: this.product_id,
        })
        .then((response) => {
          this.$store.dispatch("countCart");
          this.$store.dispatch("getCartItem");
          // this.$store.dispatch("countCart");
          this.$store.dispatch("getAllCarttotal");
          // this.$Progress.finish();
          this.$Progress.finish();
        });
    },
    callParent() {
      alert("Parent called");
      this.$emit("getSearchResult");
    },
    checkboxSearch() {
      axios
        .post("/search-checkbox", {
          category: this.cat,
          brand: this.bra,
        })
        .then((response) => {
          //console.log(response.data.multiProduct)
        });
    },
  },
  computed: {
    showCatProduct() {
      // alert(this.searchResult.length);
      // this.searchResult = this.$SearchArr;
      if(this.searchResult.length>0)
      {
        alert(this.searchResult.length);
        return this.searchResult;
      }
      else{
        alert(123);
        return this.$store.getters.getCatProduct;
      }
      
    },
    showAllCategory() {
      return this.$store.getters.getCategory;
    },
    showAllBrands() {
      return this.$store.getters.getSearchProducts;
    },
  },
  watch: {
    $route(to, from) {
      this.$Progress.start();
      this.gProduct();
      this.callParent();
      this.$Progress.finish();
    },
    /*cat(after,before){
            this.checkboxSearch();
          }*/
  },
};
</script>
