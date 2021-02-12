<template>
  <div>
    <h2 id="store-name" class="desktop-only">Ali`s Bistrorante</h2>
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
    <div class="heading">
      <i class="icon-shopping-cart"></i>&nbsp;&nbsp;&nbsp;Warenkorb
    </div>
    <!--================Cart Area =================-->
    <section class="cart_area col-md-12 bg-white nopadding toppad-15">
      <div class="table-responsive">
        <div class="cart-dilvery">
          <ul class="dilvery">
            <li>
              <input
                type="radio"
                value="dilvery"
                style="display: none"
                name="dilvery"
                id="dilvery"
              />
              <label @click="setDelivery()">Liefern</label>
            </li>
            <li>
              <label @click="setDelivery()">Abholen</label
              ><input
                style="display: none"
                type="radio"
                value="pickup"
                name="dilvery"
                id="dilvery"
                @click.prevent="setDelivery()"
              />
            </li>
          </ul>
        </div>
        <table class="table">
          <thead>
            <tr>
              <!-- <th scope="col"></th> -->
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="cart in showCartItem" v-bind:key="cart">
              <!-- <td><input type="checkbox" :value="cart.rowId"  v-model="checkItem" name=""></td> -->
              <td>
                <div class="media">
                  <div class="d-flex">
                    <img
                      :src="`${cart.options.images}`"
                      height="100px"
                      alt="Product Image"
                    />
                  </div>
                  <div class="media-body">
                    <p>{{ cart.name }}</p>
                  </div>
                </div>
              </td>
              <td>
                <h5>&pound; {{ cart.price }}</h5>
              </td>
              <td>
                <div class="product_count">
                  <input
                    type="number"
                    name="qty"
                    v-model="cart.qty"
                    @change="updateCart(cart.rowId)"
                    title="Quantity"
                    class="input-text qty"
                  />
                </div>
              </td>
              <!-- <td>
                <h5>&pound; {{ cart.subtotal }}</h5>
              </td> -->
              <!-- <td>
                <button @click.prevent="removeCart(cart.rowId)" class="btn btn-danger">
                  X
                </button>
              </td> -->
            </tr>

            <tr class="bottom_button">
              <td></td>
              <td><!-- {{checkItem}} --></td>
              <td><h5>Subtotal</h5></td>
              <td>
                <h5>&pound; {{ showSubtotal }}</h5>
              </td>
              <td></td>
            </tr>
            <tr class="out_button_area">
              <td></td>
              <td></td>
              <td></td>

              <td>
                <div class="checkout_btn_inner">
                  <router-link class="btn btn-success" to="/shipping"
                    >Checkout</router-link
                  >
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div id="widget-wrapper">
        <div id="app-widget">
          <div class="app-widget-title"><span>Jetzt App laden!</span></div>
          <div
            class="btns"
            style="
              background-image: url('https://delivery-app.app-smart.services/uploads/customer_mobile_pic/a6zLyPgTJ2iDMh6g.png');
            "
          >
            <img
              title="Jetzt App laden!"
              alt="Jetzt App laden!"
              class="qr-code"
              src="https://delivery-app.app-smart.services/uploads/customerQR/a6zLyPgTJ2iDMh6g_4788.svg"
            />
            <div class="app-img">
              <a href="https://apps.apple.com/app/id1530342126" target="_blank"
                ><img alt="App Store icon" width="100px" src="ashion/images/apple.svg"
              /></a>
            </div>
            <div class="app-img">
              <a
                href="https://play.google.com/store/apps/details?id=com.appsmart.delivery.alisbistrorante3676"
                target="_blank"
                ><img
                  alt="Google Play icon"
                  width="100px"
                  src="ashion/images/android.svg"
              /></a>
            </div>
          </div>
          <a
            class="bottom-info text-center"
            href="https://store.app-smart.com/alis-bistrorante"
            target="_blank"
            ><span>Jetzt verfügbar für iOS und Android!</span></a
          >
        </div>
      </div>
    </section>
    <!--================End Cart Area =================-->
  </div>
</template>

<script>
export default {
  name: "cart",
  data() {
    return {
      checkItem: [],
    };
  },
  methods: {
    removeCart(rowId) {
      this.$Progress.start();
      axios
        .post("/delete-cart", {
          rowId: rowId,
        })
        .then((response) => {
          this.$store.dispatch("getCartItem");
          this.$store.dispatch("countCart");
          this.$store.dispatch("getAllCarttotal");
          this.$Progress.finish();
        });
    },
    setDelivery: function () {
      document
        .querySelectorAll("label")
        .forEach((el) => el.classList.remove("selectedDelivery"));

      event.target.classList.toggle("selectedDelivery");
    },
    updateCart(rowId) {
      this.$Progress.start();
      axios
        .post("/update-cart", {
          rowId: rowId,
          qty: event.srcElement.value,
        })
        .then((response) => {
          this.$store.dispatch("getCartItem");
          this.$store.dispatch("countCart");
          this.$store.dispatch("getAllCarttotal");
          this.$Progress.finish();
        });
    },
    start() {
      this.$Progress.start();
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
