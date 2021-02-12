<template>
<div>

     
  <div class="container-fluid topmargin bg-white">
    <div class="row">
      <div class="col-lg-8">
        <h3>Your order</h3>
        <div class="checkout__order__product">
          <table class="table">
            <thead>
              <tr>
                <!-- <th scope="col"></th> -->
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="cart in showCartItem" v-bind:key="cart">
                <!-- <td><input type="checkbox" :value="cart.rowId"  v-model="checkItem" name=""></td> -->
                <td>
                  <div class="media">
                    <div class="media-body">
                      <h5>{{ cart.name }}</h5>
                    </div>
                  </div>
                </td>
                <td>
                  <h5>&pound {{ cart.price }}</h5>
                </td>
                <td>
                  <h5>{{ cart.qty }}</h5>
                </td>
                <td>
                  <h5>&puound {{ cart.subtotal }}</h5>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="checkout__order__total">
          <ul>
            <li>
              Total <span>&pound {{ showSubtotal }}</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-lg-4">
        <form @submit.prevent="orderConfirm" method="post">
          <div class="checkout__order">
            <div class="checkout__order__widget cart_inner">
              <h4>Choose Payment Method</h4>

              <table class="table table-bordered">
                <tr>
                  <td>Cash on delivery</td>
                  <td>
                    <input
                      type="radio"
                      @click="isHidden == true"
                      v-model="type"
                      name="payment_info"
                      value="cash"
                    />
                  </td>
                </tr>
               
               
                
                <tr>
                  <td>Paypal</td>
                  <td>
                    <input
                      type="radio"
                      v-model="type"
                      name="payment_info"
                      value="paypal"
                    />
                  </td>
                </tr>
              </table>

             <div v-if="type == 'cash'">
               <div class="row">
                    <div class="col-xs-12">
                      <button type="submit" class="site-btn">Pay Now</button>
                    </div>
                  </div>
             </div>

              <div v-if="type == 'paypal'">
                <form
                  role="form"
                  @submit.prevent="orderConfirm"
                  action=""
                  method="post"
                  class="require-validation"
                  data-cc-on-file="false"
                  data-stripe-publishable-key=""
                  id="payment-form"
                >
                  <div class="row">
                    <div class="col-xs-12">
                      <button type="submit" class="site-btn">Pay Now</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="cart_inner">
      <div class="table-responsive"></div>
    </div>
    <!-- ------------------------------------------------
    <div class="row">
      <div class="offset-3 col-md-6">
        <div class="card mt-5">
          <div class="card-header text-center">
            <h3>Choose a Payment Method!</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="orderConfirm" method="post">
              <button
                type="submit"
                v-if="type == 'cash'"
                class="btn btn-primary"
              >
                Confirm Order
              </button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
  </div>
  </div>
</template>

<script>
export default {
  name: "cart",
  data() {
    return {
      type: "",
      publishedKey: process.env.STRIPE_KEY,
    };
  },
  created: {
    showSubtotal() {
      return this.$store.getters.getCartSubtotal;
    },
  },
  methods: {
    orderConfirm() {
      axios
        .post("/confirm-order", {
          type: this.type,
        })
        .then((response) => {
          console.log(response);
          alert("Thanks for your order.");
          this.$store.dispatch("countCart");
          this.$router.push('/');
          
        });
    },
  },
  mounted() {
    this.$Progress.start();
    this.$store.dispatch("getCartItem");
    this.$store.dispatch("getAllCarttotal");
    this.$Progress.finish();
  },
  computed: {
    showCartItem() {
      return this.$store.getters.getCartItem;
    },
    showSubtotal() {
      return this.$store.getters.getCartSubtotal;
    },
    showSession() {
      return this.$store.getters.getSessionData;
    },
  },
};
</script>
