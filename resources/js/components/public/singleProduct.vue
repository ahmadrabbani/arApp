<template>
  <div>
    <div class="breadcrumb-option">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb__links">
              <router-link class="nav-link" :to="`/`"
                ><i class="fa fa-home"></i> Home</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="product__details__pic">
            <div class="product__details__pic__left product__thumb nice-scroll">
              <router-link class="pt active" to="#product-1"
                ><img :src="`${singleProduct.image}`" alt="First slide" /></router-link
              >
               
            </div>
            <div class="product__details__slider__content">
              <div class="product__details__pic__slider">
                <img
                  :src="`${singleProduct.image}`"
                  data-hash="product-1"
                  class="product__big__img"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="product__details__text">
            <h3>
              {{ singleProduct.product_name }}
              <span>{{ singleProduct.cat_name }}</span>
            </h3>
            <div class="rating">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <span>( 138 reviews )</span>
            </div>
            <div class="product__details__price">
              $ {{ singleProduct.product_price }}
              <span>$ {{ singleProduct.discount_price }}</span>
            </div>
            <p>
              {{ singleProduct.short_desc }}
            </p>
            <div class="product__details__button">
              <form method="post" @submit.prevent="addToCart">
                <div class="quantity">
                  <span>Quantity:</span>
                  <div class="pro-qty">
                    <input
                      type="number"
                      name="qty"
                      v-model="cartQty"
                      value="1"
                      title="Quantity"
                      class="input-text qty"
                    />
                  </div>
                </div>
                <div class="card_area">
                  <input type="submit" class="cart-btn" value="Add to Cart" />
                </div>
              </form>

              <ul>
                <li>
                  <a href="#"><span class="icon_heart_alt"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon_adjust-horiz"></span></a>
                </li>
              </ul>
            </div>
            <div class="product__details__widget">
              <ul>
                <li>
                  <span>Availability:</span>
                  <div class="stock__checkbox">
                    <label for="stockin">
                      In Stock
                      <input type="checkbox" id="stockin" />
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </li>
                <li>
                  <span>Available color:</span>
                  <div class="color__checkbox">
                    <label for="red">
                      <input
                        type="radio"
                        name="color__radio"
                        id="red"
                        checked
                      />
                      <span class="checkmark"></span>
                    </label>
                    <label for="black">
                      <input type="radio" name="color__radio" id="black" />
                      <span class="checkmark black-bg"></span>
                    </label>
                    <label for="grey">
                      <input type="radio" name="color__radio" id="grey" />
                      <span class="checkmark grey-bg"></span>
                    </label>
                  </div>
                </li>
                <li>
                  <span>Available size:</span>
                  <div class="size__btn">
                    <label for="xs-btn" class="active">
                      <input type="radio" id="xs-btn" />
                      xs
                    </label>
                    <label for="s-btn">
                      <input type="radio" id="s-btn" />
                      s
                    </label>
                    <label for="m-btn">
                      <input type="radio" id="m-btn" />
                      m
                    </label>
                    <label for="l-btn">
                      <input type="radio" id="l-btn" />
                      l
                    </label>
                  </div>
                </li>
                <li>
                  <span>Promotions:</span>
                  <p>Free shipping</p>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="product__details__tab">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  data-toggle="tab"
                  href="#tabs-1"
                  role="tab"
                  >Description</a
                >
              </li>

              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                  >Reviews ( 2 )</a
                >
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <h6>Description</h6>
                {{ singleProduct.long_desc }}
              </div>

              <div class="tab-pane" id="tabs-3" role="tabpanel">
                <h6>Reviews</h6>
                <div v-for="comment in showComment" v-bind:key="comment">
                  <p>{{ comment.comment }}</p>
                </div>
                <div class="col-lg-6">
                  <div class="review_box" v-if="showSession">
                    <h4>Post a comment</h4>
                    <form
                      @submit.prevent="comment"
                      class="row contact_form"
                      action=""
                      method="post"
                      id="contactForm1"
                      novalidate="novalidate"
                    >
                      <div class="col-md-12">
                        <div class="form-group">
                          <textarea
                            v-model="commentText"
                            class="form-control"
                            name="comment"
                            id="message1"
                            rows="2"
                            placeholder="Comment"
                          ></textarea>
                        </div>
                      </div>
                      <div class="col-md-12 text-right">
                        <button
                          type="submit"
                          value="submit"
                          class="btn btn-success"
                        >
                          Comment Now
                        </button>
                      </div>
                    </form>
                  </div>
                  <div v-else>
                    <router-link to="/user-login">Login to Comment</router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "singleProduct",
  data() {
    return {
      cartQty: "1",
      id: "",
      commentText: "",
    };
  },
  mounted() {
    this.$Progress.start();
    this.$store.dispatch("getProducstbyId", this.$route.params.id);
    this.$store.dispatch("getProductComment", this.$route.params.id);
    this.$Progress.finish();
  },
  computed: {
    singleProduct() {
      return this.$store.getters.getSingleProduct;
    },
    showSession() {
      return this.$store.getters.getSessionData;
    },
    showComment() {
      return this.$store.getters.getCommentData;
    },
  },
  methods: {
    addToCart() {
      this.$Progress.start();
      axios
        .post("/add-cart", {
          qty: this.cartQty,
          id: this.singleProduct.id,
        })
        .then((response) => {
          this.$store.dispatch("getCartItem");
          this.$store.dispatch("countCart");
          this.$store.dispatch("getAllCarttotal");
          this.$Progress.finish();
        });
    },
    comment() {
      this.$Progress.start();
      axios
        .post("/product-comment", {
          commenterId: this.showSession.id,
          commentText: this.commentText,
          productId: this.$route.params.id,
        })
        .then((response) => {
          //console.log(response.data)
          this.$store.dispatch("getProductComment", this.$route.params.id);
          this.commentText = "";
          this.$Progress.finish();
        });
    },
  },
};
</script>